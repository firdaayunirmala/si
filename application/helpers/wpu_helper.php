<?php

function is_logged_in()
{
    $ci =  get_instance();
    if (!$ci->session->userdata('user_name')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        // print_r($role_id);
        // die;
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_sub_menu', ['url' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        // print_r($menu_id);
        // die;
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->result() < 1) {
            redirect('auth/blocked');
        }
    }
}


function is_logged_inmhs()
{
    $ci =  get_instance();
    if (!$ci->session->userdata('user_name')) {
        redirect('auth/mahasiswa');
    } else {
        $role_id = $ci->session->userdata('role_id');
        //  print_r($role_id);
        // die;
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_sub_menu', ['url' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        // print_r($menu_id);
        // die;
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->result() < 1) {
            redirect('auth/blocked');
        }
    }
}

function is_logged_indsn()
{
    $ci =  get_instance();
    if (!$ci->session->userdata('user_name')) {
        redirect('auth/dosen');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_sub_menu', ['url' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->result() < 1) {
            redirect('auth/blocked');
        }
    }
}

function is_logged_inpimp()
{
    $ci =  get_instance();
    if (!$ci->session->userdata('user_name')) {
        redirect('auth/pimpinan');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_sub_menu', ['url' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->result() < 1) {
            redirect('auth/blocked');
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
