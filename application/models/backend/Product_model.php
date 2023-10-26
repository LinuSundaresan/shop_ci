<?php
class Product_model extends CI_Model {

    public function get_all_categories( $limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $this->db->select('*');
        $this->db->from('category');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function get_all_categories_count(){
        $this->db->select('*');
        $this->db->from('category');
        $q = $this->db->get();
        return $q->num_rows();
    }
}