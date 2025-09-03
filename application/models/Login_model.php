<?php 

class Login_model extends CI_model {

    public function getAllUser()
    {
        return $this->db->get('tbl_user')->result_array();
    }
}