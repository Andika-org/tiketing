<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function is_logged_in()
    {
        if (!$this->session->userdata(AUTHORIZATION::HTTP_SESSION_LOGIN_CONSTANT())) {
            redirect('welcome/login');
        }
    }
}
