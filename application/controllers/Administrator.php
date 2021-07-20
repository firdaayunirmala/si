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
        $data['datata'] = $this->Admin_model->getAllDatata();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('administrator/datata', $data);
        $this->load->view('templates/footer');
    }

    public function tambahdatata()
    {
        $data['title'] = 'Data Tugas Akhir';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('administrator/tambahdatata', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->tambahDataTa();
            $this->session->set_flashdata('message', 'Berhasil Ditambahkan!');
            redirect('administrator/datata');
        }
    }

    public function editdatata($id)
    {
        $data['title'] = 'Data Tugas Akhir';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        $data['datata'] = $this->Admin_model->getDatataById($id);
        $datata = $this->Admin_model->getDatataById($id);
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        // if ($this->form_validation->run() == false) {
        if ($this->input->post('update') == 'update') {
            $this->session->set_flashdata('message', 'Data Berhasil Diubah!');
            $this->Admin_model->ubahDatata($id);
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
        $data = $this->Admin_model->getDatataById($id);
        $this->Admin_model->hapusTa($id, $data);
        $this->session->set_flashdata('message', 'Berhasil Dihapus!');
        redirect('administrator/datata');
    }


}
