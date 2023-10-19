<?php
class Category_model extends CI_Model {

    public function get_all_categories()
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('parent_id', NULL);
        $q = $this->db->get(); 

        return $q->result_array();
    }

    public function get_category_details( $category_id )
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_id', $category_id );
        $q = $this->db->get(); 

        return $q->row_array();
    }

}
?>