<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Role_model');
        $this->load->model('Admin_model');
    }

    // untuk menampilkan SuperAdmin Punya
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $data['namarole']   = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Role baru ditambahkan!</div>');
            redirect('admin/role');
        }
    }

    public function editrole()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();
        $this->form_validation->set_rules('roleedit', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Role_model->ubahDataRole();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert"> Role Berhasil Diubah!</div>');
            redirect('admin/role');
        }
    }

    public function hapusrole()
    {
        $this->Role_model->hapusDataRole();
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert"> Role Berhasil Dihapus!</div>');
        redirect('admin/role');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Berhasil berubah!</div>');
    }

    //untuk menampilkan data admin
    public function index()
    {
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['admin'] = $this->Admin_model->getAllAdmin();
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/admin', $data);
        $this->load->view('templates/footer');
    }

    public function detailadmin($id)
    {
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['admin'] = $this->Admin_model->getAdminById($id);

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailadmin', $data);
        $this->load->view('templates/footer');
    }

    public function tambahadmin()
    {
        $data['title'] = 'Tambah Admin';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('hp', 'Hp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tambahadmin', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->tambahDataAdmin();
            $this->session->set_flashdata('message', 'Ditambahkan!');
            redirect('admin');
        }
    }

    public function hapusadmin($id)
    {
        $admin = $this->Admin_model->getAdminById($id);

        $this->Admin_model->hapusDataAdmin($id, $admin);
        $this->session->set_flashdata('message', 'Dihapus!');
        redirect('admin');
    }

    public function editadmin($id)
    {
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_name')])->row_array();

        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();


        $data['admin'] = $this->Admin_model->getAdminById($id);
        $admin = $this->Admin_model->getAdminById($id);


        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password]');
        $this->form_validation->set_rules('hp', 'Hp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editadmin', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->ubahDataAdmin($admin, $id);

            $this->session->set_flashdata('message', 'Diubah!');
            redirect('admin');
        }
    }
}
