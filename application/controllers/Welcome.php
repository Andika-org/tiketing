<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_data');
		$this->load->helper('url');
		$this->load->helper('authorization');
	}

	public function index()
	{
		$data['judul'] = "Login Tiketing";
		$this->load->view('properti/header2', $data);
		$this->load->view('login', $data);
		$this->load->view('properti/footer2', $data);
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('UserHeader', ['aUserID' => $username])->row_array();

		//User Terdaftar
		if ($user) {

			//Cek Password
			if (password_verify($password, $user['WebPassword'])) {
				$data = [
					'aUserID' => $user['aUserID']
				];
				$this->session->set_userdata($data);
				redirect('Cs/index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Anda Tidak Sesuai!</div>');
				redirect('Welcome');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Anda Tidak Sesuai!</div>');
			redirect('Welcome');
		}
	}

	public function login()
	{
		$data['judul'] = "Login Customer RS";
		$this->load->view('properti/header2', $data);
		$this->load->view('login', $data);
		$this->load->view('properti/footer2', $data);
	}

	public function proses_login()
	{
		$this->_auth();
	}

	// USER STATIC NON-DATABASE
	private function _validasi()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($username == 'admin') {
			if ($password == '123') {
				$data = [
					'username' => $username
				];
				$this->session->set_userdata($data);
				redirect('cs/index');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak benar!</div>');
				redirect('welcome/login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak ditemukan!</div>');
			redirect('welcome/login');
		}
	}

	private function _auth()
	{
		$UserName = $this->input->post('UserName');
		$Pass = $this->input->post('Pass');

		$user = $this->db->query("SELECT * FROM userstiket where username = '$UserName'")->row_array();

		if ($user) {
			if ($user['user_aktif'] == 1) {
				if (password_verify($Pass, $user['password_hash'])) {
					$data = [
						'UserName' => $user['username'],
						'DeptID' => $user['DeptID'],
						'unitrs'  => $user['unitrs'],
						'id'  => $user['id']
					];

					$this->session->set_userdata('user_data', $data);
					redirect('cs');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"> <u>Password</u> yang dimasukan salah!</div>');
					redirect('welcome');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"> <u>UserName</u> tidak tidak aktif!</div>');
				redirect('welcome');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"> <u>UserName</u> tidak terdaftar!</div>');
			redirect('welcome');
		}
	}


	private function _validasi2()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//$password = hash('sha256', $password);

		$db = $this->load->database('default', TRUE);
		$query = $db->query("select * from userheader where aUserID =  '$username' and Password =  '$password' ");

		// Jika ada hasilnya
		if ($query->num_rows() > 0) {
			$user 	= $query->row();
			$username_ 	= $user->aUserID;
			$user_data = [
				'UserID'   => $user->aUserID,
				'UserName' => $user->UserName, // misalnya ada field ini
				'Role'     => $user->Role  // atau apapun
			];

			$this->session->set_userdata(AUTHORIZATION::HTTP_SESSION_LOGIN_CONSTANT(), $user_data);
			redirect('cs/');
		} else {

			$this->session->set_flashdata('gagal', 'Oopss.. username / password salah');
			redirect('welcome/login');
		}
	}
}