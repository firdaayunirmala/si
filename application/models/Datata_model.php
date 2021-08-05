<?php

class Datata_model extends CI_Model
{
    public function getAllDatata()
    {
        return $this->db->query(
            "SELECT
                d.mhs_id ,
                d.tanggal,
                m.nim ,
                m.name ,
                d.judul ,
                d.sinopsis,
                d.status,
                dd.status as status_dosen,
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
                        d.id_user
                    FROM
                        datata d)
                order by
                    m.name";
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
                d.mhs_id ,
                d.id_user ,
                d.tanggal,
                m.nim ,
                m.name ,
                d.judul ,
                d.sinopsis,
                d.status,
                d.kode_jurusan,
                dd.id_dosen,
                dd.id as id_detail,
                dd.status as status_dosen
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


    // update data tugas akhir berdasarkan id
    public function ubahdatata($data, $id)
    {
        $this->db->where('id', $id);
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
        $this->db->delete('datata', ['id' => $id]);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}
