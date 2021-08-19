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
        $data['mahasiswa'] = $this->Datata_model->get_mahasiswa();
        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/datata', $data);
        $this->load->view('templates/footer');
    }

    public function tambahdatata()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->form_validation->run() == false) {
            $res = [
                'status' => 409,
                'message' => form_error('judul')
            ];
        } else {
            $datata = [
                'tanggal' => !empty($this->input->post('tanggal', true)) ? $this->input->post('tanggal', true) : date("Y-m-d"),
                'mhs_id' => $this->input->post('mhs_id', true),
                'judul' => $this->input->post('judul', true),
                'sinopsis' => $this->input->post('sinopsis', true),
                'status' => $this->input->post('status', true),
                'jurusan_id' => $this->input->post('jurusan_id', true),
                'status' => 0,
                'created_by' => $this->session->userdata('id'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_by' => $this->session->userdata('id'),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            $last_id = $this->Datata_model->tambahDataTa($datata);
            if ($last_id > 0) {
                $datata_detail = [
                    [
                        'datata_id' => $last_id,
                        'dosen_id' => $this->input->post('pembimbing1', true),
                        'pembimbing_ke' => 1,
                        'status' => 0,
                    ], [
                        'datata_id' => $last_id,
                        'dosen_id' => $this->input->post('pembimbing2', true),
                        'status' => 0,
                        'pembimbing_ke' => 2
                    ]
                ];
                $this->Datata_model->tambahDataTaBanyak($datata_detail);
            }

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

    public function edit_datata($id)
    {
        $datata = $this->Datata_model->getDatataById($id);

        $id = 0;
        foreach ($datata as $key => $value) {
            if ($value->datata_id != $id) {
                $data['datata'] = [
                    'datata_id' => $value->datata_id,
                    'mhs_id' => $value->mhs_id,
                    'tanggal' => $value->tanggal,
                    'nim' => $value->nim,
                    'name' => $value->name,
                    'judul' => $value->judul,
                    'sinopsis' => $value->sinopsis,
                    'status' => $value->status,
                    'jurusan_id' => $value->jurusan_id,
                    'id_dosen1' => $value->dosen_id,
                    'status_dosen1' => $value->status_dosen,
                    'id_detail1' => $value->id_detail,
                ];
                $id = $value->datata_id;
            } else {
                $data['datata']['id_dosen2'] = $value->dosen_id;
                $data['datata']['status_dosen2'] = $value->status_dosen;
                $data['datata']['id_detail2'] = $value->id_detail;
            }
        }

        echo json_encode($data);
    }


    // update data ta
    public function update_datata()
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die;
        $id = $this->input->post('datata_id');
        $status_dosen1 = $this->input->post('status_dosen1');
        $status_dosen2 = $this->input->post('status_dosen2');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->form_validation->run() == false) {
            $res = [
                'status' => 409,
                'message' => form_error('judul')
            ];
        } else {
            $datata = [
                'judul' => $this->input->post('judul', true),
                'sinopsis' => $this->input->post('sinopsis', true),
                'jurusan_id' => $this->input->post('jurusan_id', true),
                'updated_by' =>  $this->session->userdata('id'),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ];


            if ($status_dosen1 == 1 && $status_dosen2 == 1) {
                $datata['status'] = $status_dosen1;
            } elseif ($status_dosen1 == 2 && $status_dosen2 == 2) {
                $datata['status'] = $status_dosen1;
            } else {
                $datata['status'] = 0;
            }
            $respond = $this->Datata_model->ubahDatata($datata, $id);
            $datata_detail = [
                [
                    'id' => $this->input->post('id_detail1', true),
                    'dosen_id' => $this->input->post('pembimbing1', true),
                    'status' => $status_dosen1,
                    'updated_by' =>  $this->session->userdata('id'),
                    'updated_at' =>  date("Y-m-d H:i:s"),
                ], [
                    'id' => $this->input->post('id_detail2', true),
                    'dosen_id' => $this->input->post('pembimbing2', true),
                    'status' => $status_dosen2,
                    'updated_by' =>  $this->session->userdata('id'),
                    'updated_at' =>  date("Y-m-d H:i:s"),
                ]
            ];
            $this->Datata_model->ubahDataTaBanyak($datata_detail);


            if ($respond) {
                $res = [
                    'status' => 201,
                    'message' => 'Data berhasil diupdate'
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

    public function hapusdatata($id)
    {
        $res = $this->Datata_model->hapusTa($id);
        echo $res;
    }


    public function get_data()
    {
        $datata = $this->Datata_model->getAllDatata();
        $id = $i = 0;
        $data = [];
        if (count($datata) > 0) {
            foreach ($datata as $value) {

                if ($value->status_dosen == 1) {
                    $status_dosen = "<span class='badge badge-success'>Disetuju</span>";
                } elseif ($value->status_dosen == 2) {
                    $status_dosen = "<span class='badge badge-danger'>Ditolak</span>";
                } else {
                    $status_dosen = "<span class='badge badge-warning'>Proses</span>";
                }

                if ($value->status == 1) {
                    $status = "<span class='badge badge-success'>Disetuju</span>";
                } elseif ($value->status == 2) {
                    $status = "<span class='badge badge-danger'>Ditolak</span>";
                } else {
                    $status = "<span class='badge badge-warning'>Proses</span>";
                }

                if ($value->datata_id != $id) {
                    $data[$i] = [
                        $i + 1,
                        date("d-m-Y", strtotime($value->tanggal)),
                        "$value->name<br>($value->nim)",
                        $value->judul,
                        $value->jurusan_nama,
                        "$value->dosen<br>$status_dosen",
                    ];
                    $id = $value->datata_id;
                } else {
                    $aksi = "<a class='btn btn-sm btn-info' href='javascript:void(0);' title='detail' onclick='preview($id)'>
                            <i class='fa fa-eye'></i>
                        </a>
                        <a class='btn btn-sm btn-warning' href='javascript:void(0);' title='edit' onclick='set_val($id)'>
                            <i class='fa fa-pencil-alt'></i>
                        </a>
                        <a class='btn btn-sm btn-danger' href='javascript:void(0);' title='hapus' onclick='set_del($id)'>
                            <i class='fa fa-trash'></i>
                        </a>";
                    $data[$i][] = "$value->dosen<br>$status_dosen";
                    $data[$i][] = $status;
                    $data[$i][] = $aksi;
                    $i++;
                }
            }
        }

        echo json_encode($data);
    }


    // mengambil data mahasiswa yang belum terdaftar ta
    public function get_mahasiswa()
    {
        $data = $this->Datata_model->get_mahasiswa();
        echo json_encode($data);
    }
}
