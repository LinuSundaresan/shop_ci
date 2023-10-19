<?php
class Register_model extends CI_Model {

    public function save_user($data)
    {
        $this->db->insert('users',$data);
        return ($this->db->affected_rows() != 1) ? false : true; 
    }

}
?>