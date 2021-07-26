<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('Dosen_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['jurusan'] = $this->db->count_all_results('jurusan');

        $data['pimp'] = $this->db->count_all('pimpinan');
        $data['dsn'] = $this->db->count_all('dosen');
        $data['mhs'] = $this->db->count_all('mahasiswa');
        $data['d'] = $this->db->count_all('datata');

        $this->db->like('is_active', 1);
        $this->db->from('dosen');
        $data['dosen'] = $this->db->count_all_results();

        $this->db->like('is_active', 1);
        $this->db->from('mahasiswa');
        $data['mahasiswa'] = $this->db->count_all_results();

        $this->db->like('is_active', 1);
        $this->db->from('pimpinan');
        $data['pimpinan'] = $this->db->count_all_results();

        $this->db->like('role_id', 2);
        $this->db->from('user');
        $data['admin'] = $this->db->count_all_results();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function datata()
    {
        $data['title'] = 'Data Tugas Akhir';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();
        $datata = $this->Admin_model->getAllDatata();

        $id = $i = 0;
        foreach ($datata as $key => $value) {
            if ($value->id != $id) {
                $data['datata'][$i] = [
                    'id' => $value->id,
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
        $data['title'] = 'Data Tugas Akhir';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['namarole']  = $this->db->get_where('user_role', ['id' => $this->session->userdata('id')])->row_array();

        $data['mahasiswa'] = $this->Admin_model->get_mahasiswa();
        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['sinopsis'] = $this->db->get('sinopsis')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('administrator/tambahdatata', $data);
            $this->load->view('templates/footer');
        } else {
            $datata = [
                'id_user' => $this->input->post('id_user', true),
                'judul' => $this->input->post('judul', true),
                'sinopsis' => $this->input->post('sinopsis', true),
                'status' => $this->input->post('status', true),
                'kode_jurusan' => $this->input->post('jurusan', true),
            ];
            $last_id = $this->Admin_model->tambahDataTa($datata);
            $datata_detail = [
                0 => [
                    'id_datata' => $last_id,
                    'id_dosen' => $this->input->post('pembimbing1', true),
                    'pembimbing_ke' => 1
                ],
                1 => [
                    'id_datata' => $last_id,
                    'id_dosen' => $this->input->post('pembimbing2', true),
                    'pembimbing_ke' => 2
                ]
            ];
            $this->Admin_model->tambahDataTaBanyak($datata_detail);
            $this->session->set_flashdata('message', 'Berhasil Ditambahkan!');
            redirect('administrator/datata');
        }
    }

    public function editdatata($id)
    {
        $data['title'] = 'Data Tugas Akhir';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['namarole']  = $this->db->get_where('user_role', ['id' => $this->session->userdata('id')])->row_array();

        $data['mahasiswa'] = $this->Admin_model->get_mahasiswa();
        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        // $data['datata'] = $this->Admin_model->getDatataById($id);
        $datata = $this->Admin_model->getDatataById($id);

        $id = 0;
        foreach ($datata as $key => $value) {
            if ($value->id != $id) {
                $data['datata'] = [
                    'id' => $value->id,
                    'id_user' => $value->id_user,
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

        // if ($this->form_validation->run() == false) {
        if ($this->input->post('update') == 'update') {
            $datata = [
                'judul' => $this->input->post('judul', true),
                'sinopsis' => $this->input->post('sinopsis', true),
                'kode_jurusan' => $this->input->post('jurusan', true),
            ];
            $this->Admin_model->ubahDatata($datata, $id);
            $datata_detail = [
                0 => [
                    'id' => $this->input->post('id_detail1', true),
                    'id_dosen' => $this->input->post('pembimbing1', true)
                ],
                1 => [
                    'id' => $this->input->post('id_detail2', true),
                    'id_dosen' => $this->input->post('pembimbing2', true)
                ]
            ];
            $this->Admin_model->ubahDataTaBanyak($datata_detail);
            $this->session->set_flashdata('message', 'Data Berhasil Diubah!');
            redirect('administrator/datata');
        } else {
            // ambil dahulu nilai inputnya pakai $this->input->get('name inputnya') jika pakai method get
            // ambil dahulu nilai inputnya pakai $this->input->post('name inputnya') jika pakai method post
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('administrator/editskripsi', $data);
            $this->load->view('templates/footer');
        }
    }

    public function hapusdatata($id)
    {
        $this->Admin_model->hapusTa($id);
        $this->session->set_flashdata('message', 'Berhasil Dihapus!');
        redirect('administrator/datata');
    }

    public function countdown()
    {
        $data['title'] = 'Countdown Timer';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();
        $data['countdown'] = $this->db->get('countdown')->row_array();

        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('time', 'Time', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('administrator/countdown', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->updateCountDown();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Waktu Hitung Mundur Telah Diatur!</div>');
            redirect('admin/countdown');
        }
    }

    public function countdownAccess()
    {
        $status = $this->input->post('status');

        $data = [
            'status' => $status
        ];

        $this->db->set($data);
        $this->db->update('countdown');

        if ($status == 1) {
            $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Countdown Berhasil ditampilkan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Countdown Berhasil Disembunyikan!</div>');
        }
    }
}
