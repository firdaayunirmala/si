<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_inpimp();
      
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('pimpinan', ['nidn' =>
        $this->session->userdata('nidn')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pimpinan/beranda', $data);
        $this->load->view('templates/footer');
    }
}