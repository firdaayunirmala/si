<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_indsn();
        $this->load->model('Dosen_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('dosen', ['nik' =>
        $this->session->userdata('nik')])->row_array();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/dashboard', $data);
        $this->load->view('templates/footer');
        
    }

    public function bimbingan()
    {
        $data['title'] = 'Bimbingan';
        $data['user'] = $this->db->get_where('dosen', ['nik' =>
        $this->session->userdata('nik')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['bimbingan_dsn'] = $this->Dosen_model->getAllBimbingan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/bimbingan', $data);
        $this->load->view('templates/footer');
    }

    public function detailbimbingan()
    {
        $data['title'] = 'Bimbingan';
        $data['user'] = $this->db->get_where('dosen', ['nik' =>
        $this->session->userdata('nik')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['bimbingan'] = $this->Dosen_model->getAllBimbingan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/detailbimbingan', $data);
        $this->load->view('templates/footer');
    }

    public function kirimfile()
    {
        $data['title'] = 'Bimbingan';
        $data['user'] = $this->db->get_where('dosen', ['nik' =>
        $this->session->userdata('nik')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $data['bimbingan'] = $this->Dosen_model->getAllBimbingan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/kirimbimbingan', $data);
        $this->load->view('templates/footer');
    }

    public function pesan()
    {
        $data['title'] = 'Pesan';
        $data['user'] = $this->db->get_where('dosen', ['nik' =>
        $this->session->userdata('nik')])->row_array();

        $data['namarole'] = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/pesan', $data);
        $this->load->view('templates/footer');
    }

    public function kirim_chat()
    {
        $this->form_validation->set_rules('user', 'User', 'required|trim');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required|trim');
        $this->form_validation->set_rules('target', 'Target', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect("Pesan/ambil_pesan");
            //echo "salah";
        } else {
            $userid = $this->input->post("user");
            $pesan = $this->input->post("pesan");
            $id_target =  $this->input->post("target");
            $result = $this->Pesan_model->send_pesan($userid, $pesan, $id_target);
        }
        //echo json_encode($result);
        redirect("Pesan/ambil_pesan");
    }

    public function ambil_pesan()
    {
        //$session_data = $this->session->userdata('sess_member');
        //$userid = $session_data['id_user'];
        $id_target = $this->input->GET('target');
        $userid = $this->input->get('user');
        // echo "OYYYY = " . $id_target;
        $tampil = $this->Pesan_model->get_pesan($id_target, $userid);

        foreach ($tampil as $r) {
            if ($r['id_user'] == $userid) {
                echo "<li class='p-2 mb-1 rounded bg-default'><h5><b>$r[name]</b> : $r[pesan] </h5>(<i>$r[waktu]</i>)</li>";
            } else {
                echo "<li class='p-2 mb-1 rounded bg-success text-white'><h6>$r[name] : $r[pesan] </h6>(<i>$r[waktu]</i>)</li>";
            }
        }
    }
}