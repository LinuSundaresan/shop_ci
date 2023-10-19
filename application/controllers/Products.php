<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cart_model', 'cart');
    }

    public function add_to_cart(){
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        $available_stock = $this->cart->get_available_stock($product_id)['stock'];

        if ($available_stock >= $quantity) {

            $updated_stock = $available_stock - $quantity;

            $data = array('product_id'=> $product_id);
            $where = array('stock' => $updated_stock);

            $this->cart->update_stock($data, $where);

            $this->cart->add_to_cart($product_id, $quantity);

            echo 'success'; 
        } else {
            echo 'error'; 
        }

    }

}

	