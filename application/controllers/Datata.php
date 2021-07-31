<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datata extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Datata_model');
    }

    public function index()
    {
        $data['title'] = 'Data Tugas Akhir';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();
        $datata = $this->Datata_model->getAllDatata();
        $data['mahasiswa'] = $this->Datata_model->get_mahasiswa();
        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        $id = $i = 0;
        foreach ($datata as $key => $value) {
            if ($value->id != $id) {
                $data['datata'][$i] = [
                    'id' => $value->id,
                    'tanggal' => $value->tanggal,
                    'nim' => $value->nim,
                    'name' => $value->name,
                    'judul' => $value->judul,
                    'sinopsis' => $value->sinopsis,
                    'status' => $value->sinopsis,
                    'nama_jurusan' => $value->nama_jurusan,
                    'pembimbing1' => $value->dosen,
                ];
                $id = $value->id;
            } else {
                $data['datata'][$i]['pembimbing2'] = $value->dosen;
                $i++;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/datata', $data);
        $this->load->view('templates/footer');
    }

    public function tambahdatata()
    {
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->form_validation->run() == false) {
            $res = [
                'status' => 409,
                'message' => form_error('judul')
            ];
        } else {
            $datata = [
                'tanggal' => $this->input->post('tanggal', true),
                'id_user' => $this->input->post('id_user', true),
                'judul' => $this->input->post('judul', true),
                'sinopsis' => $this->input->post('sinopsis', true),
                'status' => $this->input->post('status', true),
                'kode_jurusan' => $this->input->post('jurusan', true),
            ];
            $last_id = $this->Datata_model->tambahDataTa($datata);
            $datata_detail = [
                [
                    'id_datata' => $last_id,
                    'id_dosen' => $this->input->post('pembimbing1', true),
                    'pembimbing_ke' => 1
                ], [
                    'id_datata' => $last_id,
                    'id_dosen' => $this->input->post('pembimbing2', true),
                    'pembimbing_ke' => 2
                ]
            ];
            $this->Datata_model->tambahDataTaBanyak($datata_detail);
            if ($last_id > 0) {
                $res = [
                    'status' => 201,
                    'message' => 'Data berhasil ditambahkan'
                ];
            } else {
                $res = [
                    'status' => 409,
                    'message' => 'request not acceptable'
                ];
            }
        }

        echo json_encode($res);
    }

    public function editdatata($id)
    {
        $datata = $this->Datata_model->getDatataById($id);

        $id = 0;
        foreach ($datata as $key => $value) {
            if ($value->id != $id) {
                $data['datata'] = [
                    'id' => $value->id,
                    'id_user' => $value->id_user,
                    'tanggal' => $value->tanggal,
                    'nim' => $value->nim,
                    'name' => $value->name,
                    'judul' => $value->judul,
                    'sinopsis' => $value->sinopsis,
                    'status' => $value->status,
                    'kode_jurusan' => $value->kode_jurusan,
                    'id_dosen1' => $value->id_dosen,
                    'id_detail1' => $value->id_detail,
                ];
                $id = $value->id;
            } else {
                $data['datata']['id_dosen2'] = $value->id_dosen;
                $data['datata']['id_detail2'] = $value->id_detail;
            }
        }
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->input->post('update') == 'update') {
            $datata = [
                'judul' => $this->input->post('judul', true),
                'sinopsis' => $this->input->post('sinopsis', true),
                'kode_jurusan' => $this->input->post('jurusan', true),
            ];
            $this->Datata_model->ubahDatata($datata, $id);
            $datata_detail = [
                [
                    'id' => $this->input->post('id_detail1', true),
                    'id_dosen' => $this->input->post('pembimbing1', true)
                ], [
                    'id' => $this->input->post('id_detail2', true),
                    'id_dosen' => $this->input->post('pembimbing2', true)
                ]
            ];
            $this->Datata_model->ubahDataTaBanyak($datata_detail);
            $this->session->set_flashdata('message', 'Data Berhasil Diubah!');
            redirect('administrator/datata');
        } else {
        }
    }

    public function hapusdatata($id)
    {
        $this->Datata_model->hapusTa($id);
        $this->session->set_flashdata('message', 'Berhasil Dihapus!');
        redirect('administrator/datata');
    }
}
