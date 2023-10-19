<?php
class Cart_model extends CI_Model {

    public function add_to_cart($product_id, $quantity) {
        // You can add user_id if you have user-specific carts
        $data = array(
            'login_id' => $this->session->userdata('login_id'), 
            'product_id' => $product_id,
            'quantity' => $quantity
        );

        $this->db->insert('shop_cart', $data);
    }

    public function get_available_stock( $product_id ){
        $this->db->select('stock');
        $this->db->from('products');
        $this->db->where('product_id', $product_id );
        $q = $this->db->get(); 

        return $q->row_array();
    }

    public function update_stock( $data , $where ){
        $this->db->where( $where );
        $this->db->update('products', $data );
    }

}
