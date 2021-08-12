<?php

class User_model extends CI_Model
{

    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function tambahDataUser()
    {
        $data = [
            'user_name' => $this->input->post('user_name', true),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'is_active' => $this->input->post('is_active', true),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => $this->session->userdata('user_data')['user_id'],
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => $this->session->userdata('user_data')['user_id'],
            'role_id' => ($this->input->post('jenis_akun') == 1) ? 5 : 4,
        ];

        $this->db->insert('user', $data);
        if ($this->db->affected_rows()) {
            $profil = [
                'jenis_akun' => $this->input->post('jenis_akun'),
                'profil_id' => $this->input->post('profil_id'),
                'user_id' => $this->db->insert_id(),
            ];
            $this->update_profil($profil);
            return true;
        } else {
            return false;
        }
    }

    public function ubahDataUser()
    {
        $data = [
            'user_name' => $this->input->post('user_name', true),
            'is_active' => $this->input->post('is_active', true),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => $this->session->userdata('user_data')['user_id'],
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => $this->session->userdata('user_data')['user_id'],
            'role_id' => ($this->input->post('jenis_akun') == 1) ? 5 : 4,
        ];
        if ($this->input->post('is_ganti_password') == 'on') {
            $data['password'] = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusDataUser($id, $jenis_akun)
    {
        $this->db->delete('user', ['id' => $id]);
        if ($this->db->affected_rows()) {
            if ($jenis_akun == 1) { // jika jenis akun mahasiswa
                $profil_id = $this->db->get_where('mahasiswa', ['user_id' => $id])->row()->mhs_id;
            } else {
                $profil_id = $this->db->get_where('dosen', ['user_id' => $id])->row()->dosen_id;
            }
            // echo $profil_id;
            // die;
            $data = [
                'jenis_akun' => $jenis_akun,
                'user_id' => null,
                'profil_id' => $profil_id
            ];
            $this->update_profil($data);
            return true;
        } else {
            return false;
        }
    }

    public function get_data_user($join, $custom_selector = '')
    {
        $sql = "SELECT
                    u.id,
                    u.user_name,
                    $custom_selector
                    u.is_active
                from 
                    user u
                $join
                order by 
                    u.user_name
        ";
        return $this->db->query($sql)->result();
    }

    public function get_profil($table, $selector = '')
    {
        $sql = "SELECT
                    $selector
                from 
                    $table
                where 
                    user_id is null
                order by 
                    profil_name
        ";
        return $this->db->query($sql)->result();
    }

    public function cek_username($where)
    {
        $sql = "SELECT
                    count(*) as total
                from 
                    user
                where 
                    0 = 0 $where";
        return ($this->db->query($sql)->row()->total > 0) ? true : false;
    }


    public function update_profil($data)
    {
        if ($data['jenis_akun'] == 1) { // jenis akun mahasiswa
            $id = 'mhs_id';
            $table = 'mahasiswa';
        } else {
            $id = 'dosen_id';
            $table = 'dosen';
        }
        $this->db->where($id, $data['profil_id']);
        unset($data['profil_id']);
        unset($data['jenis_akun']);
        $this->db->update($table, $data);
    }
}
