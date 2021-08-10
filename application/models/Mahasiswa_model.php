<?php

class Mahasiswa_model extends CI_Model
{

    public function getAllMahasiswa()
    {
        return $this->db->get('mahasiswa')->result_array(); //semua baris
    }

    public function getMahasiswaById($mhs_id)
    {
        return $this->db->get_where('mahasiswa', ['mhs_id' => $mhs_id])->row_array();
    }

    public function getAllBimbingan()
    {
        return $this->db->get('bimbingan')->result_array(); //semua baris
    }

    public function upload()
    {
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['imagemhs']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile/mahasiswa';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagemhs')) {
                return $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }
        return "default.jpg";
    }


    public function tambahDataMahasiswa()
    {
        $data = [
            'nim' => $this->input->post('nim', true),
            'name' => $this->input->post('nama', true),
            'semester' => $this->input->post('semester', true),
            'totalsks' => $this->input->post('totalsks', true),
            'jurusan_id' => $this->input->post('jurusan', true),
            'email' => $this->input->post('emailmhs', true),
            'hp' => $this->input->post('hpmhs', true),
            'image' => $this->upload(),
            // 'password' => password_hash($this->input->post('passwordmhs1'), PASSWORD_DEFAULT),
            'is_active' => $this->input->post('aktif', true),
        ];

        $this->db->insert('mahasiswa', $data);
    }

    public function ubahDataMahasiswa($mhs, $mhs_id)
    {
        $upload_image = $_FILES['imagemhs']['name'];
        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile/mahasiswa';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagemhs')) {
                $old_image = $mhs['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/mahasiswa/' . $old_image);
                }
                $new_image =  $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }
        $nim = $this->input->post('nim', true);
        $name = $this->input->post('namalengkap', true);
        $semester = $this->input->post('semester', true);
        $totalsks = $this->input->post('totalsks', true);
        $jurusan = $this->input->post('jurusan', true);
        $email = $this->input->post('email', true);
        $hp = $this->input->post('hp', true);
        $password = password_hash($this->input->post('passwordmhs1'), PASSWORD_DEFAULT);
        $is_active = $this->input->post('aktifmhs', true);

        $data = [
            'nim' => $nim,
            'name' => $name,
            'semester' => $semester,
            'totalsks' => $totalsks,
            'kode_jurusan' => $jurusan,
            'email' => $email,
            'hp' => $hp,
            'is_active' => $is_active
        ];
        $this->db->set($data);
        if ($this->input->post('passwordmhs1') != null) {
            $this->db->set('password', $password);
        }
        $this->db->where('mhs_id', $mhs_id);
        $this->db->update('mahasiswa');
    }

    public function hapusDataMahasiswa($mhs_id, $mhs)
    {
        $old_image = $mhs['image'];
        if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/mahasiswa/' . $old_image);
        }
        //$this->db->where('id', $id);
        $this->db->delete('mahasiswa', ['mhs_id' => $mhs_id]);
    }
}
