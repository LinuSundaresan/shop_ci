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

    public function get_user_carted_products( $login_id ){
        $this->db->select('shop_cart.*, products.*, SUM(shop_cart.quantity) AS quantity');
        $this->db->from('shop_cart');
        $this->db->join('products', 'products.product_id = shop_cart.product_id', 'LEFT');
        $this->db->where('login_id', $login_id );
        $this->db->group_by('shop_cart.product_id');
        $q = $this->db->get(); 
        //echo $this->db->last_query();
        //exit;
        return $q->result_array();
    }

}
