<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function send_pesan($id_user, $pesan, $id_target)
    {
        $this->db->set('id_user', $id_user);
        $this->db->set('pesan', $pesan);
        $this->db->set('id_target', $id_target);
        $this->db->insert('pesan');
        $this->db->insert_id();
    }

    public function get_pesan($target, $userid)
    {
        $sql = "SELECT c.*, u.name FROM pesan c
        JOIN mahasiswa u
        ON c.id_user = u.nim
        WHERE (c.id_user = '" . $userid . "' AND id_target = '" . $target . "') OR (c.id_user = '" . $target . "' AND id_target = '" . $userid . "')
        ORDER BY waktu asc";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
}
