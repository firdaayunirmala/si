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
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/loginadmin');
            $this->load->view('templates/auth_footer');
        } else {
            //validasinya sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        $id_role = $user['role_id'];
        $role = $this->db->get_where('user_role', ['id' => $id_role])->row_array();
        //jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('administrator');
                    } else if ($user['role_id'] == 2) {
                        redirect('administrator');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak aktif! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar </div>');
            redirect('auth');
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
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('nim');
        $this->session->unset_userdata('nidn');
        $this->session->unset_userdata('nik');

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
        if ($this->session->userdata('nim')) {
            redirect('user');
        }
        $this->form_validation->set_rules('nim', 'Nim', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/loginmahasiswa');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya sukses
            $this->_loginmhs();
        }
    }

    private function _loginmhs()
    {
        $nim = $this->input->post('nim');
        $password = $this->input->post('password');

        $user = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
        $id_role = $user['role_id'];
        $role = $this->db->get_where('user_role', ['id' => $id_role])->row_array();
        // jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'nim' => $user['nim'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {

                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert"> Salah Password !</div>');
                    redirect('auth/mahasiswa');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert"> NIM belum aktif, silahkan hubungi admin</div>');
                redirect('auth/mahasiswa');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">NIM belum tersedia!</div>');
            redirect('auth/mahasiswa');
        }
    }

    public function dosen()
    {
        if ($this->session->userdata('nik')) {
            redirect('user');
        }
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/logindosen');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya sukses
            $this->_logindosen();
        }
    }

    private function _logindosen()
    {
        $nik = $this->input->post('nik');
        $password = $this->input->post('password');

        $user = $this->db->get_where('dosen', ['nik' => $nik])->row_array();
        $id_role = $user['role_id'];
        $role = $this->db->get_where('user_role', ['id' => $id_role])->row_array();
        // jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'nik' => $user['nik'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {

                        redirect('administrator');
                    } else {

                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert"> Salah password!</div>');
                    redirect('auth/dosen');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert"> NIK tidak aktif!</div>');
                redirect('auth/dosen');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">NIK tidak terdaftar!</div>');
            redirect('auth/dosen');
        }
    }

    public function pimpinan()
    {
        if ($this->session->userdata('nidn')) {
            redirect('user');
        }
        $this->form_validation->set_rules('nidn', 'NIDN', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/loginpimpinan');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya sukses
            $this->_loginpimpinan();
        }
    }

    private function _loginpimpinan()
    {
        $nidn = $this->input->post('nidn');
        $password = $this->input->post('password');

        $user = $this->db->get_where('pimpinan', ['nidn' => $nidn])->row_array();
        $id_role = $user['role_id'];
        $role = $this->db->get_where('user_role', ['id' => $id_role])->row_array();

        // jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'nidn' => $user['nidn'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id']
                    ];


                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {

                        redirect('admin');
                    } else {

                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert"> Wrong password!</div>');
                    redirect('auth/pimpinan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert"> This NIDN has not been activated!</div>');
                redirect('auth/pimpinan');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">NIDN is not registered!</div>');
            redirect('auth/pimpinan');
        }
    }
}
