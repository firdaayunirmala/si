<?php

class Datata_model extends CI_Model
{
    public function getAllDatata()
    {
        return $this->db->query(
            "SELECT
                d.datata_id ,
                d.mhs_id ,
                m.nim ,
                m.name ,
                d.judul ,
                d.sinopsis,
                d.status,
                dd.status as status_dosen,
                j.jurusan_nama ,
                d2.name dosen
            FROM
                datata d
            inner join datata_detail dd on
                dd.datata_id = d.datata_id 
            inner join mahasiswa m on
                m.mhs_id = d.mhs_id 
            inner join dosen d2 on
                d2.dosen_id = dd.dosen_id 
            inner join jurusan j on
                j.jurusan_id = d.jurusan_id 
            ORDER BY
                m.nim"
        )->result();

        // return $this->db->get('datata')->result_array();
    }


    // get mahasiswa
    public function get_mahasiswa()
    {
        $sql = "SELECT
                    m.mhs_id ,
                    m.name ,
                    m.nim
                FROM
                    mahasiswa m
                where
                    m.is_active = 1
                    and m.mhs_id not in (
                    SELECT
                        d.mhs_id
                    FROM
                        datata d)
                order by
                    m.nim";
        $res = $this->db->query($sql)->result();
        return $res;
    }


    // tambah data tugas akhir
    public function tambahDataTa($data)
    {
        $this->db->insert('datata', $data);
        return $this->db->insert_id();
    }


    // tambah data detail tugas akhir
    public function tambahDataTaBanyak($data)
    {
        $this->db->insert_batch('datata_detail', $data);
    }


    // ambil data tugas akhir berdasarkan id
    public function getDatataById($id)
    {
        // return $this->db->get_where('datata', ['id' => $id])->row_array();
        return $this->db->query(
            "SELECT
                d.datata_id ,
                d.mhs_id ,
                d.tanggal,
                m.nim ,
                m.name ,
                d.judul ,
                d.sinopsis,
                d.status,
                d.jurusan_id,
                dd.dosen_id,
                dd.id as id_detail,
                dd.status as status_dosen
            FROM
                datata d
            inner join datata_detail dd on
                dd.datata_id = d.datata_id
            inner join mahasiswa m on
                m.mhs_id = d.mhs_id
            where
                d.datata_id = $id"
        )->result();
    }


    // update data tugas akhir berdasarkan id
    public function ubahdatata($data, $id)
    {
        $this->db->where('datata_id', $id);
        $this->db->update('datata', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }


    // update data detail tugas akhir berdasarkan id
    public function ubahDataTaBanyak($data)
    {
        $this->db->update_batch('datata_detail', $data, 'id');
    }


    // hapus data tugas akhir berdasarkan id
    public function hapusTa($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('datata', ['datata_id' => $id]);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}
