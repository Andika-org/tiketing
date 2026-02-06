<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    private $table = 'userstiket';

    public function get_all_users()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert_user($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_user($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete_user($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
