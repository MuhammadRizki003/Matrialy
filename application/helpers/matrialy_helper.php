<?php
function cek_user_login()
{
    $ci = get_instance();
    if ($ci->session->userdata('role_id') != "2") {
        $ci->session->set_flashdata('message', '<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>
        Akses Ditolak!!</strong> Silahkan Login Terlebih Dahulu</div></div>');
        redirect('home');
    }
}
function user_only()
{
    $ci = get_instance();
    if ($ci->session->userdata('role_id') == "1") {
        redirect('admin/home_admin');
    }
}
