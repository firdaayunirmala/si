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
        $data['role'] = $this->db->get('user_role')->result_array();

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

        $data['admin'] = $this->Admin_model->getAllAdmin();
        $data['dosen'] = $this->Admin_model->getAllDosen();

        if ($this->input->post('tambah') == 'tambah') {
            list($user_id, $role_id) = explode('|', $this->input->post('user_id'));
            $data = [
                'id' => $user_id,
                'role_id' => ($role_id == 4) ? 8 : 9,
            ];
            $this->Admin_model->ubahDataAdmin($data);
            redirect('admin');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/admin', $data);
            $this->load->view('templates/footer');
        }
    }

    public function detailadmin($id)
    {
        $data['title'] = 'Admin';

        $data['admin'] = $this->Admin_model->getAdminById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailadmin', $data);
        $this->load->view('templates/footer');
    }


    public function hapusadmin()
    {

        list($user_id, $role_id) = explode('|', $this->input->get('data'));
        $data = [
            'id' => $user_id,
            'role_id' => ($role_id == 8) ? 4 : 6,
        ];
        $this->Admin_model->ubahDataAdmin($data);
        redirect('admin');
    }
}
