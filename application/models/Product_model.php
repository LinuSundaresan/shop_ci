<?php
class Product_model extends CI_Model {

    public function get_new_products()
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('status', 1);
        $q = $this->db->get(); 

        return $q->result_array();
    }

    public function get_featured_products()
    {
        $this->db->select('*');
        $this->db->from('products');
        $q = $this->db->get(); 

        return $q->result_array();
    }

    public function get_product_details( $product_id )
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('product_id', $product_id);
        $q = $this->db->get(); 
        return $q->row();
    }

    public function get_category_products( $category_id , $limit, $offset )
    {
        $this->db->limit($limit, $offset);
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('category_id' , $category_id );
        $q = $this->db->get(); 
        return $q->result_array();
    }

    public function get_category_products_count( $category_id )
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('category_id' , $category_id );
        $q = $this->db->get(); 
        return $q->num_rows();
    }

}
?>