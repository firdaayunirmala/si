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
    }

    public function index()
    {
        $data['title'] = 'Jurusan';

        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        $query = "SELECT
                    j.id ,
                    j.nama_jurusan ,
                    COALESCE(total_mahasiswa.total, 0) as total
                FROM
                    jurusan j
                left join (
                    select
                        count(*) as total,
                        m.kode_jurusan
                    from
                        mahasiswa m
                    group by
                        m.kode_jurusan) as total_mahasiswa on
                    total_mahasiswa.kode_jurusan = j.id";

        $data['jur_mhs'] = $this->db->query($query)->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('operation/jurusan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_jurusan' => $this->input->post('jurusan')
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
        $data['user'] = $this->db->get_where('user', ['user_name' => $this->session->userdata('user_name')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('operation/mahasiswa/mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function tambahmahasiswa()
    {
        $data['title'] = 'Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[mahasiswa.nim]', [
            'is_unique' => 'This nim has already registered!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('passwordmhs1', 'Password', 'required|trim|min_length[3]|matches[passwordmhs2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('passwordmhs2', 'Password', 'required|trim|matches[passwordmhs1]');
        $this->form_validation->set_rules('hpmhs', 'Hp', 'required|trim');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('totalsks', 'TotalSks', 'required|trim');
        $this->form_validation->set_rules('emailmhs', 'Email', 'required|trim|valid_email|is_unique[mahasiswa.email]', [
            'is_unique' => 'This email has already registered!'
        ]);

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($mhs_id);
        $mhs = $this->Mahasiswa_model->getMahasiswaById($mhs_id);
        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        $this->form_validation->set_rules('namalengkap', 'NamaLengkap', 'required|trim');
        $this->form_validation->set_rules('passwordmhs1', 'Password', 'trim|min_length[3]|matches[passwordmhs2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('passwordmhs2', 'Password', 'trim|matches[passwordmhs1]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('hp', 'Hp', 'required');

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
        $data['user'] = $this->db->get_where('user', ['user_name' => $this->session->userdata('user_name')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

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

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();
        $data['pimpinan'] = $this->Pimpinan_model->getAllPimpinan();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

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

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

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
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

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
}
