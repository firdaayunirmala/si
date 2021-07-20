<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_inmhs();
        $this->load->model('Mahasiswa_model');
        $this->load->model('Pesan_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('mahasiswa', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function bimbingan()
    {
        $data['title'] = 'Bimbingan';
        $data['user'] = $this->db->get_where('mahasiswa', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();
        $data['bimbingan_mhs'] = $this->db->get('bimbingan_mhs')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/bimbingan', $data);
        $this->load->view('templates/footer');
    }

    public function detail()
    {
        $data['title'] = 'Detail Bimbingan';
        $data['user'] = $this->db->get_where('mahasiswa', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/detailbimbingan', $data);
        $this->load->view('templates/footer');
    }

    public function kirimfile()
    {
        $data['title'] = 'Upload Data Bimbingan';
        $data['user'] = $this->db->get_where('mahasiswa', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $data['user_data'] = $this->db->get_where('mahasiswa', ['nim' =>
        $this->session->userdata('nim')])->result_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        //get data TA
        $data_ta = $this->db->get_where('datata', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $where = 'nik = ' . $data_ta['pembimbing1'] . ' OR nik = ' . $data_ta['pembimbing2'] . '';
        $data['dosen'] = $this->db->get_where('dosen', $where)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/kirimfile', $data);
        $this->load->view('templates/footer');
    }

    public function uploadFile()
    {
        $this->load->view('mahasiswa/uploadfile');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('mahasiswa', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function pesan()
    {
        $data['title'] = 'Pesan';
        $data['user'] = $this->db->get_where('mahasiswa', ['nim' =>
        $this->session->userdata('nim')])->row_array();

        $data['namarole'] = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/pesan', $data);
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
