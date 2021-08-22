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
        $this->db->set('user_id', $data['user_id']);
        $this->db->set('pesan', $data['pesan']);
        $this->db->set('target_id', $data['target_id']);
        $this->db->set('type_pengirim', $data['type_pengirim']);
        $this->db->insert('pesan');
        return $this->db->insert_id();
    }

    public function get_pesan($target, $userid, $jenis = 'mahasiswa')
    {
        $target = !empty($target) ? $target : 0;
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
                            p.user_id
                        from
                            pesan p
                        inner join mahasiswa m on
                            m.user_id = p.user_id
                        where
                            p.user_id = $userid
                            and p.target_id = $target
                    UNION
                        SELECT
                            p.pesan,
                            d.name,
                            p.waktu,
                            p.type_pengirim,
                            p.user_id
                        from
                            pesan p
                        inner join dosen d on
                            d.user_id = p.user_id
                        where
                            p.user_id = $target
                            and p.target_id = $userid) as pesan
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
                            p.user_id
                        from
                            pesan p
                        inner join dosen d on
                            d.user_id = p.user_id
                        where
                            p.user_id = $userid
                            and p.target_id = $target
                    UNION
                        SELECT
                            p.pesan,
                            m.name,
                            p.waktu,
                            p.type_pengirim,
                            p.user_id
                        from
                            pesan p
                        inner join mahasiswa m on
                            m.user_id = p.user_id
                        where
                            p.user_id = $target
                            and p.target_id = $userid) as pesan
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
                        d2.user_id as value,
                        d2.name
                    from
                        datata d
                    inner join datata_detail dd on
                        dd.datata_id = d.datata_id
                    inner join dosen d2 on
                        d2.dosen_id = dd.dosen_id
                    inner join mahasiswa m on
                        m.mhs_id = d.mhs_id
                    where
                        m.user_id = $id
                    order BY 
                        dd.pembimbing_ke";
        } elseif ($jenis == 'mahasiswa') {
            $sql = "SELECT
                        m.user_id as value,
                        m.name
                    from
                        datata d
                    inner join datata_detail dd on
                        dd.datata_id = d.datata_id
                    inner join mahasiswa m on
                        m.mhs_id = d.mhs_id
                    inner join dosen d2 on
                        d2.dosen_id = dd.dosen_id
                    where 
                        d2.user_id = $id
                    order BY
                        m.name";
        }
        $res = $this->db->query($sql)->result_array();
        // echo $this->db->last_query();
        // die;
        return $res;
    }
}
