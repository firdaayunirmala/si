<?php

class Admin_model extends CI_Model
{
    public function getAllDatata()
    {
        return $this->db->query(
            "SELECT
                d.id ,
                m.nim ,
                m.name ,
                d.judul ,
                d.sinopsis,
                d.status,
                j.nama_jurusan ,
                d2.name dosen
            FROM
                datata d
            inner join datata_detail dd on
                dd.id_datata = d.id
            inner join mahasiswa m on
                m.id = d.id_user
            inner join dosen d2 on
                d2.id = dd.id_dosen
            inner join jurusan j on
                j.id = d.kode_jurusan
            ORDER BY
                m.nim"
        )->result();

        // return $this->db->get('datata')->result_array();
    }

    public function getDatataById($id)
    {
        // return $this->db->get_where('datata', ['id' => $id])->row_array();
        return $this->db->query(
            "SELECT
                d.id ,
                d.id_user ,
                m.nim ,
                m.name ,
                d.judul ,
                d.sinopsis,
                d.status,
                d.kode_jurusan,
                dd.id_dosen,
                dd.id as id_detail
            FROM
                datata d
            inner join datata_detail dd on
                dd.id_datata = d.id
            inner join mahasiswa m on
                m.id = d.id_user
            where
                d.id = $id"
        )->result();
    }

    public function sinopsis()
    {
        $upload_file = $_FILES['filename']['name'];
        if ($upload_file) {
            $config['upload_path']          = './filebimbingan/';
            $config['allowed_types']        = 'doc|docx|pdf';
            $config['max_size']             = 1000000;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('filename')) {
                $sinopsis =  $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
            $data = [
                'sinopsis' =>  $sinopsis
            ];
            $this->db->insert('datata', $data);
        }
    }

    public function ubahdatata($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('datata', $data);
    }

    public function ubahDataTaBanyak($data)
    {
        $this->db->update_batch('datata_detail', $data, 'id');
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

    public function tambahDataTa($data)
    {
        $this->db->insert('datata', $data);
        return $this->db->insert_id();
    }

    public function tambahDataTaBanyak($data)
    {
        $this->db->insert_batch('datata_detail', $data);
    }

    public function hapusTa($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('datata', ['id' => $id]);
    }

    public function updateCountDown()
    {
        $data = [
            'date' => $this->input->post('date', true),
            'time' => $this->input->post('time', true),
        ];

        $query = "SELECT id FROM countdown order by id desc limit 1";
        $id = $this->db->query($query)->row_array();

        $this->db->set($data);
        $this->db->where('id', $id['id']);
        $this->db->update('countdown');
    }


    // get mahasiswa
    public function get_mahasiswa()
    {
        $this->db->select('id, nim, name');
        $this->db->from('mahasiswa');
        $this->db->where('is_active', 1);
        $this->db->order_by('name', 'ASC');
        $res = $this->db->get()->result();
        return $res;
    }
}
