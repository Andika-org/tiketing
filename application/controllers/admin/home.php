<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('user_model');
        $this->load->model('live_model');
        $this->load->helper('content');


        if ($this->user_model->is_logged_in() == FALSE)
            redirect(base_url(), 'refresh');
    }

/* Indikator RS */
    public function index() {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        // $url = 'http://183.91.84.99:9092/webapi_ci/dashboard/getdata/all';
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // $data = curl_exec($curl);
        // curl_close($curl);
        // $result = json_decode($data);
        // var_dump($result);

        // $data1 = file_get_contents('http://183.91.84.99:9092/webapi_ci/dashboard/getdata/all');
        // var_dump($data1);
        $view['bor_harian'] = $this->live_model->get_bor_harian();
        $view['content'] = 'admin/home';
        $view['data'] = $this->live_model->get_all();
        $view['nama'] = $this->live_model->view_thamrin()->result();
        // print_r($this->live_model->get_all());
        $this->load->view('admin/index', $view);
        //$this->load->view('page/debitur', $view);
    }

    public function view_thamrin(){
        $data['data'] = $this->live_model->view_thamrin();
    }
}
