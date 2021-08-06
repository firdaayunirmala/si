<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_mahasiswa_model', 'mhs');
        $this->load->model('User_dosen_model', 'dsn');
        $this->load->model('User_pimpinan_model', 'pimp');
    }

    public function index()
    {
        $data['title'] = 'My Profile';

        $role_id = $this->session->userdata('user_data')['role_id'];

        $data['user'] = $this->db->get_where('user', ['user_name' =>
        $this->session->userdata('user_data')['user_name']])->row_array();

        $url = "";
        if ($role_id == 1 || $role_id == 2) {
            is_logged_in();
            $url = 'user/index';
        } elseif ($role_id == 6) {
            is_logged_inpimp();
            $url = 'pimpinan/index';
        } elseif ($role_id == 4) {
            is_logged_indsn();
            $url = 'dosen/index';
        } elseif ($role_id == 5) {
            is_logged_inmhs();
            $url = 'mahasiswa/index';
        } else {
            redirect('home');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view($url, $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $role_id = $this->session->userdata('user_data')['role_id'];

        if ($role_id == 1 || $role_id == 2) {
            is_logged_in();
            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/edit', $data);
                $this->load->view('templates/footer');
            } else {
                $user_name = $this->input->post('name');
                $email = $this->input->post('email');

                // cek jika ada gambar yang akan diupload
                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']     = '2048';
                    $config['upload_path'] = './assets/img/profile/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $old_image = $data['user']['image'];
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }

                        $new_image = $this->upload->data('file_name');
                        $this->db->set('image', $new_image);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }

                $this->db->set('user_name', $user_name);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="alert
                alert-success" role="alert">Profil berhasil di perbaharui!</div>');
                redirect('user');
            }
        } elseif ($role_id == 6) {
            is_logged_inpimp();
            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            $user = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();

            $data['jurusan'] = $this->db->get('jurusan')->result_array();

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pimpinan/edit', $data);
                $this->load->view('templates/footer');
            } else {
                $this->pimp->ubahpimpinan($user);

                $this->session->set_flashdata('message', '<div class="alert
                alert-success" role="alert">Profil berhasil di perbarui !</div>');
                redirect('user');
            }
        } elseif ($role_id == 4) {
            is_logged_indsn();
            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            $user = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('dosen/edit', $data);
                $this->load->view('templates/footer');
            } else {
                $this->dsn->ubahdosen($user);

                $this->session->set_flashdata('message', '<div class="alert
                alert-success" role="alert">Profil berhasil di perbarui !</div>');
                redirect('user');
            }
        } elseif ($role_id == 5) {
            is_logged_inmhs();

            $nim =  $this->session->userdata('user_name');
            $query = "SELECT * 
                    FROM mahasiswa INNER JOIN jurusan
                      ON mahasiswa.kode_jurusan = jurusan.id
                      WHERE mahasiswa.nim = $nim  
                      ORDER BY mahasiswa.nim ASC
                 ";
            $data['datamhs'] = $this->db->query($query)->row_array();

            $data['jurusan'] = $this->db->get('jurusan')->result_array();

            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            $user = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('mahasiswa/edit', $data);
                $this->load->view('templates/footer');
            } else {

                $this->mhs->ubahmahasiswa($user);

                $this->session->set_flashdata('message', '<div class="alert
                alert-success" role="alert">Profil berhasil di perbarui !</div>');
                redirect('user');
            }
        } else {
            redirect('home');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Ubah Password';
        $data['namarole']  = $this->db->get_where('user_role', ['id' =>
        $this->session->userdata('id')])->row_array();

        $role_id = $this->session->userdata('role_id');

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', ' Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($role_id == 1) {
            is_logged_in();
            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/changepassword', $data);
                $this->load->view('templates/footer');
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                if (!password_verify($current_password, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Wrong current password!</div>');
                    redirect('user/changepassword');
                } else {
                    if ($current_password == $new_password) {
                        $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">New password cannot be the same as current password!</div>');
                        redirect('user/changepassword');
                    } else {
                        // password sudah oke 
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $this->db->set('password', $password_hash);
                        $this->db->where('email', $this->session->userdata('email'));
                        $this->db->update('user');

                        $this->session->set_flashdata('message', '<div class="alert
                    alert-success" role="alert">Password changed!</div>');
                        redirect('user/changepassword');
                    }
                }
            }
        } elseif ($role_id == 2) {
            is_logged_in();
            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/changepassword', $data);
                $this->load->view('templates/footer');
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                if (!password_verify($current_password, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Wrong current password!</div>');
                    redirect('user/changepassword');
                } else {
                    if ($current_password == $new_password) {
                        $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">New password cannot be the same as current password!</div>');
                        redirect('user/changepassword');
                    } else {
                        // password sudah oke 
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $this->db->set('password', $password_hash);
                        $this->db->where('email', $this->session->userdata('email'));
                        $this->db->update('user');

                        $this->session->set_flashdata('message', '<div class="alert
                    alert-success" role="alert">Password changed!</div>');
                        redirect('user/changepassword');
                    }
                }
            }
        } elseif ($role_id == 6) {
            is_logged_inpimp();
            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/changepassword', $data);
                $this->load->view('templates/footer');
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                if (!password_verify($current_password, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Wrong current password!</div>');
                    redirect('user/changepassword');
                } else {
                    if ($current_password == $new_password) {
                        $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">New password cannot be the same as current password!</div>');
                        redirect('user/changepassword');
                    } else {
                        // password sudah oke 
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $this->db->set('password', $password_hash);
                        $this->db->where('nidn', $this->session->userdata('nidn'));
                        $this->db->update('pimpinan');

                        $this->session->set_flashdata('message', '<div class="alert
                    alert-success" role="alert">Password changed!</div>');
                        redirect('user/changepassword');
                    }
                }
            }
        } elseif ($role_id == 4) {
            is_logged_indsn();
            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/changepassword', $data);
                $this->load->view('templates/footer');
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                if (!password_verify($current_password, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Wrong current password!</div>');
                    redirect('user/changepassword');
                } else {
                    if ($current_password == $new_password) {
                        $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">New password cannot be the same as current password!</div>');
                        redirect('user/changepassword');
                    } else {
                        // password sudah oke 
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $this->db->set('password', $password_hash);
                        $this->db->where('nik', $this->session->userdata('nik'));
                        $this->db->update('dosen');

                        $this->session->set_flashdata('message', '<div class="alert
                    alert-success" role="alert">Password changed!</div>');
                        redirect('user/changepassword');
                    }
                }
            }
        } elseif ($role_id == 5) {
            is_logged_inmhs();
            $data['user'] = $this->db->get_where('user', ['user_name' =>
            $this->session->userdata('user_name')])->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/changepassword', $data);
                $this->load->view('templates/footer');
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                if (!password_verify($current_password, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Wrong current password!</div>');
                    redirect('user/changepassword');
                } else {
                    if ($current_password == $new_password) {
                        $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">New password cannot be the same as current password!</div>');
                        redirect('user/changepassword');
                    } else {
                        // password sudah oke 
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $this->db->set('password', $password_hash);
                        $this->db->where('nim', $this->session->userdata('nim'));
                        $this->db->update('mahasiswa');

                        $this->session->set_flashdata('message', '<div class="alert
                    alert-success" role="alert">Password Berubah!</div>');
                        redirect('user/changepassword');
                    }
                }
            }
        } else {
            redirect('home');
        }
    }
}
