<?php
class Login_model extends CI_Model {

    public function get_user($where)
    {
        $this->db->select('*');
        $this->db->from('shop_login');
        $this->db->where($where);  
        $q = $this->db->get(); 

        return $q->result_array();
    }

}
?>