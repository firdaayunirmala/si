<?php

class Admin_model extends CI_Model
{
    public function getAllDatata()
    {
        return $this->db->query(
            "SELECT 
                d.*,
                j.nama_jurusan 
            FROM datata d
            INNER JOIN jurusan j ON d.kode_jurusan = j.id  
            ORDER BY d.nim ASC"
        )->result_array();
        // return $this->db->get('datata')->result_array();
    }
    public function getDatataById($id)
    {
        return $this->db->get_where('datata', ['id' => $id])->row_array();
    }

    public function ubahdatata($id)
    {
        $nama = $this->input->post('nama', true);
        $judul = $this->input->post('judul', true);
        $pembimbing1 = $this->input->post('pembimbing1', true);
        $pembimbing2 = $this->input->post('pembimbing2', true);

        $data = [
            'nama' => $nama,
            'judul' => $judul,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,

        ];
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('datata');
    }

    public function getAllAdmin()
    {
        return $this->db->get_where('user', ['role_id' => 2])->result_array();
    }

    public function getAdminById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function upload()
    {
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                return $this->upload->data('file_name');
            }
        }
        return "default.jpg";
    }

    public function tambahDataAdmin()
    {
        $data = [
            'name' => $this->input->post('nama', true),
            'jk' => $this->input->post('jk', true),
            'email' => $this->input->post('email', true),
            'hp' => $this->input->post('hp', true),
            'image' => $this->upload(),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => $this->input->post('aktif', true),
            'date_created' => time()
        ];

        $this->db->insert('user', $data);
    }

    public function ubahDataAdmin($admin, $id)
    {
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {

                $old_image = $admin['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                $new_image =  $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $name = $this->input->post('nama', true);
        $jk = $this->input->post('jk', true);
        $email = $this->input->post('email', true);
        $hp = $this->input->post('hp', true);
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $is_active =  $this->input->post('aktif', true);

        $data = [
            'name' => $name,
            'jk' => $jk,
            'email' => $email,
            'hp' => $hp,
            'is_active' => $is_active
        ];
        $this->db->set($data);
        if ($this->input->post('password') != null) {
            $this->db->set('password', $password);
        }
        $this->db->where('id', $id);
        $this->db->update('user');
    }


    public function hapusDataAdmin($id, $admin)
    {
        $old_image = $admin['image'];
        if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
        }

        //$this->db->where('id', $id);
        $this->db->delete('user', ['id' => $id]);
    }

    public function getAllname()
    {
        return $this->db->get('name')->result_array();
    }

    public function tambahDataTa()
    {
        $data = [
            'nim' => $this->input->post('nim', true),
            'nama' => $this->input->post('nama', true),
            'judul' => $this->input->post('judul', true),
            'kode_jurusan' => $this->input->post('jurusan', true),
            'pembimbing1' => $this->input->post('pembimbing1', true),
            'pembimbing2' => $this->input->post('pembimbing2', true),
        ];

        $this->db->insert('datata', $data);
    }

    public function hapusTa($id)
    {
        //$this->db->where('id', $id);
    
        $this->db->delete('datata', ['id' => $id]);
    }
}
