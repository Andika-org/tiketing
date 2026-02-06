<?php

use AUTHORIZATION as GlobalAUTHORIZATION;

class AUTHORIZATION
{

    public static function HTTP_SESSION_LOGIN_CONSTANT()
    {
        return 'xxMhtFinance#4215533';
    }

    public static function REDIRECT_TIMEOUT_SESSION()
    {
        $CI = &get_instance();
        $username = $CI->session->userdata(GlobalAUTHORIZATION::HTTP_SESSION_LOGIN_CONSTANT());
        if ($username == '' || $username == FALSE) {
            //echo 'kesini 5';exit();
            $CI->session->set_flashdata('sukses', 'Session Berakhir, Silahkan Login Kembali');
            redirect('welcome/login');
        }
    }
}
