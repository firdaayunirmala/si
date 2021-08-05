<?php

class Pimpinan_model extends CI_Model
{
    public function getAllPimpinan()
    {
        return $this->db->get('pimpinan')->result_array();
    }

    public function getPimpinanById($pimp_id)
    {
        return $this->db->get_where('pimpinan', ['pimp_id' => $pimp_id])->row_array();
    }

    public function upload()
    {
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['imagepimpinan']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile/pimpinan';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagepimpinan')) {
                return $this->upload->data('file_name');
            }
        }
        return "default.jpg";
    }

    public function tambahDataPimpinan()
    {
        $pimp_id = $this->input->post('id', true);
        $data = [
            'pimp_id' => $pimp_id,
            'nidn' => $this->input->post('nidn', true),
            'name' => $this->input->post('namalengkap', true),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => $this->input->post('email', true),
            'hp' => $this->input->post('hp', true),
            'is_active' => $this->input->post('aktif', true),
            'image' => $this->upload(),
            'role_id' => 6
        ];
        $this->db->insert('pimpinan', $data);
    }

    public function ubahDataPimpinan($pimpinan, $pimp_id)
    {
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['imagepimpinan']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile/pimpinan';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('imagepimpinan')) {
                $old_image = $pimpinan['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/pimpinan/' . $old_image);
                }
                $new_image =  $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }
        $nidn = $this->input->post('nidn', true);
        $name = $this->input->post('namalengkap', true);
        $email = $this->input->post('email', true);
        $hp = $this->input->post('hp', true);
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $is_active =  $this->input->post('aktifpimpinan', true);

        $data = [
            'nidn' => $nidn,
            'name' => $name,
            'email' => $email,
            'hp' => $hp,
            'is_active' => $is_active
        ];
        $this->db->set($data);
        if ($this->input->post('password') != null) {
            $this->db->set('password', $password);
        }
        $this->db->where('id', $pimp_id);
        $this->db->update('pimpinan');
    }

    public function hapusDataPimpinan($pimp_id, $pimpinan)
    {
        $old_image = $pimpinan['image'];
        if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/pimpinan/' . $old_image);
        }
        //$this->db->where('id', $id);
        $this->db->delete('pimpinan', ['pimp_id' => $pimp_id]);
    }
}
