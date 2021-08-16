<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function send_pesan($data)
    {
        $this->db->set('id_user', $data['id_user']);
        $this->db->set('pesan', $data['pesan']);
        $this->db->set('id_target', $data['id_target']);
        $this->db->set('type_pengirim', $data['type_pengirim']);
        $this->db->insert('pesan');
        return $this->db->insert_id();
    }

    public function get_pesan($target, $userid, $jenis = 'mahasiswa')
    {
        if ($jenis == 'mahasiswa') {
            $sql = "SELECT
                    *
                FROM
                    (
                    SELECT
                        p.pesan,
                        m.name,
                        p.waktu,
                        p.type_pengirim,
                        p.id_user
                    from
                        pesan p
                    inner join mahasiswa m on
                        m.id = p.id_user
                    where
                        p.id_user = $userid
                        and p.id_target = $target
                UNION
                    SELECT
                        p.pesan,
                        d.name,
                        p.waktu,
                        p.type_pengirim,
                        p.id_user
                    from
                        pesan p
                    inner join dosen d on
                        d.id = p.id_user
                    where
                        p.id_user = $target
                        and p.id_target = $userid) as pesan
                order by
                    pesan.waktu ASC";
        } else {
            $sql = "SELECT
                    *
                FROM
                    (
                    SELECT
                        p.pesan,
                        d.name,
                        p.waktu,
                        p.type_pengirim,
                        p.id_user
                    from
                        pesan p
                    inner join dosen d on
                        d.id = p.id_user
                    where
                        p.id_user = $userid
                        and p.id_target = $target
                UNION
                    SELECT
                        p.pesan,
                        m.name,
                        p.waktu,
                        p.type_pengirim,
                        p.id_user
                    from
                        pesan p
                    inner join mahasiswa m on
                        m.id = p.id_user
                    where
                        p.id_user = $target
                        and p.id_target = $userid) as pesan
                order by
                    pesan.waktu ASC";
        }
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function ambil_target($jenis = 'mahasiswa', $id = 0)
    {
        if ($jenis == 'dosen') {
            $sql = "SELECT
                    d2.id as value,
                    d2.name
                from
                    datata d
                inner join datata_detail dd on
                    dd.id_datata = d.id
                inner join dosen d2 on
                    d2.id = dd.id_dosen
                where 
                    d.id_user = $id
                order BY
                    dd.pembimbing_ke";
        } elseif ($jenis == 'mahasiswa') {
            $sql = "SELECT
                    d.user_id as value,
                    m.name
                from
                    datata d
                inner join datata_detail dd on
                    dd.id_datata = d.id
                inner join mahasiswa m on
                    m.mhs_id = d.user_id
                where 
                    dd.id_dosen = $id
                order BY
                    m.name";
        }
        $res = $this->db->query($sql)->result_array();
        return $res;
    }
}
