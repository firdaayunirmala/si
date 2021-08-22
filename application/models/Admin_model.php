<?php

class Admin_model extends CI_Model
{
    public function getAllDatata()
    {
    return $this->db->get('datata')->result_array();
    }

    public function getDatataById($id)
    {
        // return $this->db->get_where('datata', ['id' => $id])->row_array();
        return $this->db->query(
            "SELECT
                d.id ,
                d.id_user ,
                d.tanggal,
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
        return $this->db->query(
            "SELECT
            u.id,
            d.name,
            d.email ,
            d.hp ,
            d.image ,
            u.role_id,
            u.is_active
        from
            user u
        left join dosen d on
            u.id = d.user_id
        where
            u.is_active = 1
            and (u.role_id = 1 or u.role_id = 2)"
        )->result_array();
    }

    public function getAllDosen()
    {
        return $this->db->query(
            "SELECT
                u.id,
                d.name,
                u.role_id
            from
                user u
            left join dosen d on
                u.id = d.user_id
            where
                u.is_active = 1
                and (u.role_id = 4 or u.role_id = 6)"
        )->result_array();
    }

    public function getAdminById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function upload()
    {
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['imagedosen']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile/dosen';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagedosen')) {
                return $this->upload->data('file_name');
            }
        }
        return "default.jpg";
    }
    
    public function tambahDataAdmin()
    {
        $dosen_id = $this->input->post('dosen_id', true);
        $data = [
            'dosen_id' => $dosen_id,
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'hp' => $this->input->post('hp', true),
            'image' => $this->upload(),
            'is_active' => $this->input->post('aktif', true),
        ];

        $this->db->insert('dosen', $data);
    }

    public function ubahDataAdmin($data)
    {
        $this->db->set($data);
        $this->db->where('id', $data['id']);
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

    // tugas akhir
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


    // countdown
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
