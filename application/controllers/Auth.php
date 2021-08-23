<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('user_name')) {
            redirect('user');
        }
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/loginadmin');
            $this->load->view('templates/auth_footer');
        } else {
            //validasinya sukses
            $this->_login('admin');
        }
    }

    private function _login($jenis = '')
    {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['user_name' => $user_name])->row_array();
        //jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    if ($user['role_id'] == 5) {
                        $table = 'mahasiswa';
                    } else {
                        $table = 'dosen';
                    }
                    $profil = $this->db->get_where($table, ['user_id' => $user['id']])->row_array();
                    $data = [
                        "user_data" => [
                            'user_name' => $profil['name'],
                            'user_fullname' => ($user['role_id'] == 5) ? $profil['user_fullname'] : $profil['name'],
                            'role_id' => $user['role_id'],
                            'user_id' => $user['id'],
                            'image' => $profil['image'],
                        ]
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1 || $user['role_id'] == 2) {
                        redirect('administrator');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah </div>');
                    redirect('home');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun tidak aktif! </div>');
                $url = "";
                if ($jenis == 'admin') {
                    $url = "auth";
                } elseif ($jenis == 'dosen') {
                    $url = "auth/dosen";
                } elseif ($jenis == 'pimpinan') {
                    $url = "auth/pimpinan";
                } else {
                    $url = "auth/mahasiswa";
                }
                redirect($url);
            }
        } else {
            $title = "";
            $url = "";
            if ($jenis == 'admin') {
                $title = "Username";
                $url = "auth";
            } elseif ($jenis == 'dosen') {
                $title = "NIDN";
                $url = "auth/dosen";
            } elseif ($jenis == 'pimpinan') {
                $title = "NIDN";
                $url = "auth/pimpinan";
            } else {
                $title = "NIM";
                $url = "auth/mahasiswa";
            }
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $title . ' belum terdaftar </div>');
            redirect($url);
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah teregistrasi!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password terlalu singkat!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Firda User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()

            ];

            // siapkan token

            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">Berhasil registrasi. Silahkan Login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_data');

        $this->session->set_flashdata('message', '<div class=\'alert alert-success\' role=\'alert\'>Berhasil Keluar</div>');
        redirect('home');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Salah token. </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Salah email. </div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'trim|required|min_length[3]|matches[password2]'
        );
        $this->form_validation->set_rules(
            'password2',
            'Repeat Password',
            'trim|required|min_length[3]|matches[password1]'
        );
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ubah Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('auth');
        }
    }

    public function mahasiswa()
    {
        if ($this->session->userdata('user_name')) {
            redirect('user');
        }
        $this->form_validation->set_rules('user_name', 'Nim', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/loginmahasiswa');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya sukses
            $this->_login('mahasiswa');
        }
    }


    public function dosen()
    {
        if ($this->session->userdata('user_name')) {
            redirect('user');
        }
        $this->form_validation->set_rules('user_name', 'NIK', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/logindosen');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya sukses
            $this->_login('dosen');
        }
    }


    public function pimpinan()
    {
        if ($this->session->userdata('user_name')) {
            redirect('user');
        }
        $this->form_validation->set_rules('user_name', 'NIDN', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/loginpimpinan');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya sukses
            $this->_login('pimpinan');
        }
    }
}
