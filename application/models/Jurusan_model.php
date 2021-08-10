<?php
class Jurusan_model extends CI_model
{
    public function hapusDataJurusan($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('jurusan', ['jurusan_id' => $id]);
    }

    public function getJurusanById($id)
    {
        return $this->db->get_where('jurusan', ['jurusan_id' => $id])->row_array();
    }

    public function detailJurusanById($id)
    {
        $query = "SELECT jurusan_nama, COUNT(*) as total  
        FROM mahasiswa m 
        INNER JOIN jurusan j ON m.jurusan_id = j.jurusan_id 
        WHERE m.jurusan_id = $id";
        return $this->db->query($query)->row_array();
    }

    public function editjurusan()
    {
        $jurusan = $this->input->post('jurusanedit', true);
        $id =  $this->input->post('id', true);
        $data = [
            "jurusan_nama" => $jurusan
        ];

        $this->db->set($data);
        $this->db->where('jurusan_id', $id);
        $this->db->update('jurusan');
    }
}
