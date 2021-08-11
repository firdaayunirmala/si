<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Jurusan_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Dosen_model');
        $this->load->model('Pimpinan_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = 'Jurusan';

        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        $query = "SELECT
                    j.jurusan_id ,
                    j.jurusan_nama ,
                    COALESCE(total_mahasiswa.total, 0) as total
                FROM
                    jurusan j
                left join (
                    select
                        count(*) as total,
                        m.jurusan_id
                    from
                        mahasiswa m
                    group by
                        m.jurusan_id) as total_mahasiswa on
                    total_mahasiswa.jurusan_id = j.jurusan_id ";

        $data['jur_mhs'] = $this->db->query($query)->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/jurusan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'jurusan_nama' => $this->input->post('jurusan')
            ];
            $this->db->insert('jurusan', $data);
            $this->session->set_flashdata('message', 'Ditambahkan!');
            redirect('operation');
        }
    }

    public function detailjurusan($id)
    {
        $data['title'] = 'Jurusan';

        $data['jurusan'] = $this->Jurusan_model->detailJurusanById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/jurusan/detailjurusan', $data);
        $this->load->view('templates/footer');
    }

    public function editjurusan()
    {
        $data['title'] = 'Jurusan';

        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        $this->form_validation->set_rules('jurusanedit', 'Jurusan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/jurusan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Jurusan_model->editjurusan();
            $this->session->set_flashdata('message', 'Berhasil diubah!');
            redirect('operation');
        }
    }

    public function hapusjurusan($id)
    {
        $this->Jurusan_model->hapusDataJurusan($id);
        $this->session->set_flashdata('message', 'Jurusan Berhasil Dihapus!');
        redirect('operation');
    }

    public function mahasiswa()
    {
        $data['title'] = 'Mahasiswa';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/mahasiswa/mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function tambahmahasiswa()
    {
        $data['title'] = 'Mahasiswa';
        $this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[mahasiswa.nim]', ['is_unique' => 'This nim has already registered!']);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        // $this->form_validation->set_rules('hpmhs', 'Hp', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('totalsks', 'TotalSks', 'required|trim');
        $this->form_validation->set_rules('emailmhs', 'Email', 'required|trim|valid_email|is_unique[mahasiswa.email]', ['is_unique' => 'This email has already registered!']);

        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/mahasiswa/tambahmahasiswa', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('message', 'Ditambahkan!');
            redirect('operation/mahasiswa', 'refresh');
        }
    }

    public function detailmahasiswa($mhs_id)
    {
        $data['title'] = 'Mahasiswa';

        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($mhs_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/mahasiswa/detailmahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function editmahasiswa($mhs_id)
    {
        $data['title'] = 'Mahasiswa';

        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($mhs_id);
        $mhs = $this->Mahasiswa_model->getMahasiswaById($mhs_id);
        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        $this->form_validation->set_rules('namalengkap', 'NamaLengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        // $this->form_validation->set_rules('hp', 'Hp', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/mahasiswa/editmahasiswa', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Mahasiswa_model->ubahDataMahasiswa($mhs, $mhs_id);
            $this->session->set_flashdata('message', 'Diubah!');
            redirect('operation/mahasiswa');
        }
    }
    public function hapusmahasiswa($mhs_id)
    {
        $mhs = $this->Mahasiswa_model->getMahasiswaById($mhs_id);
        $this->Mahasiswa_model->hapusDataMahasiswa($mhs_id, $mhs);
        $this->session->set_flashdata('message', 'Dihapus!');
        redirect('operation/mahasiswa');
    }

    public function dosen()
    {
        $data['title'] = 'Dosen Pembimbing';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/dosen/dosen', $data);
        $this->load->view('templates/footer');
    }

    public function dosenAccess()
    {
        $status = $this->input->post('status');
        $dosen_id = $this->input->post('id');
        $data = [
            'is_active' => $status
        ];
        $this->db->set($data);
        $this->db->where('dosen_id', $dosen_id);
        $this->db->update('dosen');
        if ($status == 1) {
            $this->session->set_flashdata('message', 'Aktif!');
        } else {
            $this->session->set_flashdata('message', 'Tidak Aktif');
        }
    }

    public function tambahdosen()
    {
        $data['title'] = 'Dosen';

        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|is_unique[dosen.nik]', [
            'is_unique' => 'This nik has already registered!'
        ]);
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[dosen.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('hp', 'Hp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/dosen/tambahdosen', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Dosen_model->tambahDataDosen();
            $this->session->set_flashdata('message', 'Ditambahkan!');
            redirect('operation/dosen');
        }
    }

    public function detaildosen($id)
    {
        $data['title'] = 'Dosen';

        $data['dosen'] = $this->Dosen_model->getDosenById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/dosen/detaildosen', $data);
        $this->load->view('templates/footer');
    }
    public function editdosen($id)
    {
        $data['title'] = 'Dosen';

        $data['dosen'] = $this->Dosen_model->getDosenById($id);
        $dosen = $this->Dosen_model->getDosenById($id);

        $this->form_validation->set_rules('namalengkap', 'NamaLengkap', 'required|trim');
        $this->form_validation->set_rules('passworddosen1', 'Password', 'trim|min_length[3]|matches[passworddosen2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('passworddosen2', 'Password', 'trim|matches[passworddosen1]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('hp', 'Hp', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/dosen/editdosen', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Dosen_model->ubahDataDosen($dosen, $id);

            $this->session->set_flashdata('message', 'Diubah!');
            redirect('operation/dosen');
        }
    }

    public function hapusdosen($id)
    {
        $dosen = $this->Dosen_model->getDosenById($id);

        $this->Dosen_model->hapusDataDosen($id, $dosen);
        $this->session->set_flashdata('message', 'Dihapus!');
        redirect('operation/dosen');
    }

    public function pimpinan()
    {
        $data['title'] = 'Pimpinan';
        $data['pimpinan'] = $this->Pimpinan_model->getAllPimpinan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/pimpinan/pimpinan', $data);
        $this->load->view('templates/footer');
    }

    public function pimpinanAccess()
    {
        $status = $this->input->post('status');
        $pimp_id = $this->input->post('pimp_id');

        $data = [
            'is_active' => $status
        ];

        $this->db->set($data);
        $this->db->where('pimp_id', $pimp_id);
        $this->db->update('pimpinan');

        if ($status == 1) {
            $this->session->set_flashdata('message', 'Aktif!');
        } else {
            $this->session->set_flashdata('message', 'Tidak Aktif');
        }
    }

    public function tambahpimpinan()
    {
        $data['title'] = 'Pimpinan';

        $this->form_validation->set_rules('nidn', 'NIDN', 'required|trim|is_unique[pimpinan.nidn]', [
            'is_unique' => 'This nidn has already registered!'
        ]);
        $this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pimpinan.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('hp', 'Hp', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/pimpinan/tambahpimpinan', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Pimpinan_model->tambahDataPimpinan();
            $this->session->set_flashdata('message', 'Ditambahkan!');
            redirect('operation/pimpinan');
        }
    }
    public function detailpimpinan($pimp_id)
    {
        $data['title'] = 'Pimpinan';

        $data['pimpinan'] = $this->Pimpinan_model->getPimpinanById($pimp_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/pimpinan/detailpimpinan', $data);
        $this->load->view('templates/footer');
    }
    public function editpimpinan($pimp_id)
    {
        $data['title'] = 'Pimpinan';

        $this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password]');

        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        $this->form_validation->set_rules('hp', 'Hp', 'required|trim');

        $data['pimpinan'] = $this->Pimpinan_model->getPimpinanById($pimp_id);
        $pimpinan = $this->Pimpinan_model->getPimpinanById($pimp_id);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/pimpinan/editpimpinan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pimpinan_model->ubahDataPimpinan($pimpinan, $pimp_id);

            $this->session->set_flashdata('message', 'Diubah!');
            redirect('operation/pimpinan');
        }
    }
    public function hapuspimpinan($pimp_id)
    {
        $pimpinan = $this->Pimpinan_model->getPimpinanById($pimp_id);

        $this->Pimpinan_model->hapusDataPimpinan($pimp_id, $pimpinan);
        $this->session->set_flashdata('message', 'Dihapus!');
        redirect('operation/pimpinan');
    }


    // begin : MASTER USER DATA
    public function user()
    {
        $data['title'] = 'User';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('operation/user/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahuser()
    {
        $res = $this->User_model->tambahDataUser();
        echo json_encode($res);
    }

    public function detailuser($user_id)
    {
        $data['title'] = 'User';

        $data['user'] = $this->User_model->getUserById($user_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/user/detailuser', $data);
        $this->load->view('templates/footer');
    }

    public function edituser()
    {
        $res = $this->User_model->ubahDataUser();
        echo json_encode($res);
    }
    public function hapususer($user_id, $jenis_akun)
    {
        $res = $this->User_model->hapusDataUser($user_id, $jenis_akun);
        echo json_encode($res);
    }


    public function get_data_user()
    {
        $join = "";
        if ($this->input->get('jenis_akun') == 1) {
            $join .= " INNER JOIN mahasiswa m on m.user_id = u.id ";
            $custom_selector = "m.name as user_fullname,";
        } else {
            $join .= " INNER JOIN dosen d on d.user_id = u.id ";
            $custom_selector = "d.name as user_fullname,";
        }
        $res = $this->User_model->get_data_user($join, $custom_selector);
        $id = $i = 0;
        $data = [];
        if (count($res) > 0) {
            foreach ($res as $value) {

                if ($value->is_active == 1) {
                    $status = "<span class='badge badge-success'>Aktif</span>";
                } else {
                    $status = "<span class='badge badge-danger'>Non Aktif</span>";
                }

                $id = $value->id;
                $isi = "$id|$value->user_name|$value->user_fullname|$value->is_active";
                $aksi = "<a class='btn btn-sm btn-info' href='javascript:void(0);' title='detail' onclick='preview($id)'>
                            <i class='fa fa-eye'></i>
                        </a>
                        <a class='btn btn-sm btn-warning' href='javascript:void(0);' title='edit' onclick='set_val(\"$isi\")'>
                            <i class='fa fa-pencil-alt'></i>
                        </a>
                        <a class='btn btn-sm btn-danger' href='javascript:void(0);' title='hapus' onclick='set_del($id)'>
                            <i class='fa fa-trash'></i>
                        </a>";
                $data[$i] = [
                    $i + 1,
                    "$value->user_name",
                    "$value->user_fullname",
                    $status,
                    $aksi
                ];
                $i++;
            }
        }

        echo json_encode($data);
    }


    public function get_profil()
    {
        $table = "";
        if ($this->input->get('jenis_akun') == 1) {
            $table = "mahasiswa";
            $selector = "mhs_id as profil_id,name as profil_name";
        } else {
            $table = "dosen";
            $selector = "dosen_id as profil_id,name as profil_name";
        }
        $data = $this->User_model->get_profil($table, $selector);

        echo json_encode($data);
    }


    public function cek_username()
    {
        $user_name = $this->input->post('user_name');
        $user_name_lama = $this->input->post('user_name_lama');
        $id = $this->input->post('id');
        $where = " AND user_name = '$user_name'";

        if (!empty($id)) {
            $where .= " AND user_name != '$user_name_lama'";
        }

        $data = $this->User_model->cek_username($where);
        if ($data) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    // end : MASTER USER DATA
}
