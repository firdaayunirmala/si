<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('dosen/cabim_model');
    }

    public function index()
    {
        $data['title'] = 'Calon Mahasiswa Bimbingan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('dosen/cabim_v', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {
        # code...
    }

    public function detailjurusan($id)
    {
        $data['jurusan'] = $this->Jurusan_model->detailJurusanById($id);
    }

    public function editjurusan()
    {
        $data['jurusan'] = $this->db->get('jurusan')->result_array();

        $this->Jurusan_model->editjurusan();
        redirect('operation');
    }

    public function hapusjurusan($id)
    {
        $this->Jurusan_model->hapusDataJurusan($id);
        redirect('operation');
    }
}
