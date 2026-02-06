<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(['form', 'url']);
        $username = get_user_username();  // Output: 'andika'
        $dept_id = get_user_dept_id();
    }

    public function index()
    {
        $data = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id(),
            'unitrs' => get_user_unitrs(),
            'id' => get_user_id()
        ];
        $user_info = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id()
        ];

        $data['judul'] = "User";
        $data['user'] = $user = get_user_dept_id();
        $data['users'] = $this->User_model->get_all_users();

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('user/index', $data);
        $this->load->view('properti/footer', $data);
    }

    public function create()
    {
        $data = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id(),
            'unitrs' => get_user_unitrs(),
            'id' => get_user_id()
        ];

        $data['judul'] = "Add User";
        $data['user'] = $user = get_user_dept_id();
        $data['users'] = $this->User_model->get_all_users();
        $data['dept'] = $this->db->query("Select * From userV2_Dept")->result_array();
        $data['rs'] = $rs = $this->db->query("Select * From tiket_rs")->result_array();

        // print_r($rs);
        // exit;

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('user/create', $data);
        $this->load->view('properti/footer', $data);
    }

    public function store()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password_hash' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'unitrs' => $this->input->post('unitrs'),
            'DeptID' => $this->input->post('deptid'),
            'user_level' => $this->input->post('user_level'),
            'user_aktif' => $this->input->post('user_aktif'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->User_model->insert_user($data);
        redirect('user');
    }

    public function edit($id)
    {
        $data = [
            'username' => get_user_username(),
            'dept_id' => get_user_dept_id(),
            'unitrs' => get_user_unitrs(),
            'id' => get_user_id()
        ];

        $data['judul'] = "Edit User";
        $data['user'] = $user = get_user_dept_id();
        $data['edituser'] = $this->User_model->get_user_by_id($id);
        $data['rs'] = $this->db->get('tiket_rs')->result_array();
        $data['dept'] = $this->db->get('userV2_Dept')->result_array();

        $this->load->view('properti/header', $data);
        $this->load->view('properti/menu', $data);
        $this->load->view('user/edit', $data);
        $this->load->view('properti/footer');
    }


    public function update($id)
    {
        $data = [
            'username' => $this->input->post('username'),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'unitrs' => $this->input->post('unitrs'),
            'DeptID' => $this->input->post('deptid'),
            'user_level' => $this->input->post('user_level'),
            'user_aktif' => $this->input->post('user_aktif'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!empty($this->input->post('password'))) {
            $data['password_hash'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->User_model->update_user($id, $data);
        redirect('user');
    }

    public function delete($id)
    {
        $this->User_model->delete_user($id);
        redirect('user');
    }
}