<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cart_model', 'cart');
        $this->load->model('Category_model', 'category');
        $this->load->model('Product_model','product');
    }

    public function categories(){
        $category_id = $this->uri->segment(3);
        $this->data['category_details'] = $this->category->get_category_details( $category_id );
        $this->data['categories'] = $this->category->get_all_categories();
        $this->load->view('category', $this->data);
    }

    public function get_products_by_category_1()
    {
        $category_id = $this->input->post('category_id');

        $this->load->library('pagination');
        $config['base_url'] = base_url().'products/categories/'.$category_id;
        $config['first_url'] = base_url() . 'products/categories/' . $category_id . '/1';
        $config['total_rows'] = $this->product->get_category_products_count( $category_id );
        $config['per_page'] = 3; // Number of categories to display per page
        $config['use_page_numbers'] = true; // Use page numbers instead of offsets
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['attributes'] = ['class' => 'page-link'];
        $this->pagination->initialize($config);

        $offset = $this->input->post('pageno');
        $rowperpage = 3;

        
        $all_category_products = $this->product->get_category_products($category_id , $rowperpage, $offset);
        $pagination_links = $this->pagination->create_links();

        $data = "";
        foreach($all_category_products as $product)
        {
            $data.= '<div class="col-sm-6 col-md-4 col-lg-3 ">
                    <div class="item">
            <div class="products">
                <div class="product">
                <div class="product-image">
                    <div class="image"> 
                    <a href="detail.html">
                    <img src="'.base_url().'uploads/product_images/'.$product['product_image'].'" alt=""> 
                        <img src="'.base_url().'uploads/product_images/'.$product['product_image'].'" alt="" class="hover-image">
                    </a> 
                </div>
                    
                    <div class="tag new"><span>new</span></div>
                </div>
                <div class="product-info text-left">
                    <h3 class="name"><a href="detail.html">'.$product['product_name'].'</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> '.$product['price'].' </span> <span class="price-before-discount">$ 800</span> </div>
                    
                </div>
                <div class="cart clearfix animate-effect">
                    <div class="action">
                    <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            </div>
            </div>   
            </div>';
        }
        $response = array(
            'products' => $data,
            'pagination' => $pagination_links
        );
    
        echo json_encode($response);
    }


    public function get_products_by_category(){
    
        $category_id = $this->input->post('category_id');
        $rowperpage = 6;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'products/categories/'.$category_id;
        $config['first_url'] = 1;
        $config['total_rows'] = $this->product->get_category_products_count( $category_id );
        $config['per_page'] = 6; // Number of categories to display per page
        $config['use_page_numbers'] = true; // Use page numbers instead of offsets
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['attributes'] = ['class' => 'page-link'];
        $this->pagination->initialize($config);
    
        $offset = $this->input->post('pageno');
        
        $all_category_products = $this->product->get_category_products($category_id , $rowperpage, $offset);
        $pagination_links = $this->pagination->create_links();
        $data = "";
    
        foreach($all_category_products as $product)
        {
            $data.= '<div class="col-sm-6 col-md-4 col-lg-3 ">
            <div class="item">
                <div class="products">
                    <div class="product">
                    <div class="product-image">
                        <div class="image"> 
                        <a href="detail.html">
                        <img src="'.base_url().'uploads/product_images/'.$product['product_image'].'" alt=""> 
                            <img src="'.base_url().'uploads/product_images/'.$product['product_image'].'" alt="" class="hover-image">
                        </a> 
                    </div>
                        
                        <div class="tag new"><span>new</span></div>
                    </div>
                    <div class="product-info text-left">
                        <h3 class="name"><a href="'.base_url().'products/product_details/'.$product['product_id'].'">'.$product['product_name'].'</a></h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                        <div class="product-price"> <span class="price"> '.$product['price'].' </span> <span class="price-before-discount">$ 800</span> </div>
                        
                    </div>
                    <div class="cart clearfix animate-effect">
                        <div class="action">
                        <ul class="list-unstyled">
                            <li class=" btn-group">
                            <button class="btn btn-primary icon add-cart-button" data-toggle="tooltip" type="button" data-product-id="'.$product['product_id'].'"> <i class="fa fa-shopping-cart"  ></i> </button>
                            <button class="btn btn-primary cart-btn add-cart-button" type="button"  data-product-id="'.$product['product_id'].'">Add to cart</button>
                            </li>
                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                            <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                </div>   
            </div>';
      }
        $response = array(
            'products' => $data,
            'pagination' => $pagination_links
        );
    
        echo json_encode($response);
    }



    public function product_details()
    {
        $product_id = $this->uri->segment(3);
        $data['products'] = $this->product->get_product_details( $product_id );
        // print_r($data);
        // die();
        $this->load->view('product_details' , $data);
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

	