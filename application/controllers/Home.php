<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->model('Product_model','product');
      $this->load->model('Category_model','category');
  }

  public function index()
	{
		$this->load->view('welcome_message');
	}

  public function dashboard()
  {
      $data['categories'] = $this->category->get_all_categories();
      $this->load->view('dashboard' , $data);
  }

  public function get_latest_products()
  {
      $type = $this->input->post('category_type');
      $all_latest_products = $this->product->get_new_products($type);

      $data = "";
      foreach($all_latest_products as $product)
      {
          $data.= '<div class="item item-carousel">
          <div class="products">
            <div class="product">
              <div class="product-image">
                <div class="image"> 
                <a href="'.base_url().'home/product_details/'.$product['product_id'].' ">
                    <img src="'.base_url().'uploads/product_images/'.$product['product_image'].'" alt=""> 
                    <img src="'.base_url().'uploads/product_images/'.$product['product_image'].'" alt="" class="hover-image">
                </a> 
              </div>
                
                <div class="tag new"><span>new</span></div>
              </div>
              
              <div class="product-info text-left">
                <h3 class="name"><a href="'.base_url().'home/product_details/'.$product['product_id'].' ">'.$product['product_name'].'</a></h3>
                <div class="rating rateit-small"></div>
                <div class="description"></div>
                <div class="product-price"> <span class="price"> $' .$product['price'].' </span> <span class="price-before-discount">$' .$product['price'].'</span> </div>
              
                
              </div>
              <div class="cart clearfix animate-effect">
                <div class="action">
                  <ul class="list-unstyled">
                    <li class=" btn-group">
                      <button data-toggle="tooltip" class="btn btn-primary icon add-cart-button" type="button" title="Add Cart" data-product-id="'.$product['product_id'].'"> <i class="fa fa-shopping-cart"></i> </button>
                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                    </li>
                    <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                    <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                  </ul>
                </div>
              </div>
            </div>
            
          </div>
        </div>';
      }

      echo $data;

  }


  public function get_featured_products()
  {
      //$type = $this->input->post('category_type');
      $all_latest_products = $this->product->get_featured_products();

      $data = "";
      foreach($all_latest_products as $product)
      {
          $data.= '<div class="item item-carousel">
          <div class="products">
            <div class="product">
              <div class="product-image">
                <div class="image"> 
                <a href="'.base_url().'home/product_details/'.$product['product_id'].' ">
                    <img src="'.base_url().'uploads/product_images/'.$product['product_image'].'" alt=""> 
                    <img src="'.base_url().'uploads/product_images/'.$product['product_image'].'" alt="" class="hover-image">
                </a> 
              </div>
                
                <div class="tag new"><span>new</span></div>
              </div>
              
              <div class="product-info text-left">
                <h3 class="name"><a href="'.base_url().'home/product_details/'.$product['product_id'].' ">'.$product['product_name'].'</a></h3>
                <div class="rating rateit-small"></div>
                <div class="description"></div>
                <div class="product-price"> <span class="price"> $' .$product['price'].' </span> <span class="price-before-discount">$' .$product['price'].'</span> </div>
              
                
              </div>
              <div class="cart clearfix animate-effect">
                <div class="action">
                  <ul class="list-unstyled">
                    <li class="add-cart-button btn-group">
                      <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                    </li>
                    <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                    <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                  </ul>
                </div>
              </div>
            </div>
            
          </div>
        </div>';
      }

      echo $data;

  }

  public function category( $category_id )
  {
    
    $category_id = $this->uri->segment(3);
    $this->data['category_details'] = $this->category->get_category_details( $category_id );
    $this->data['categories'] = $this->category->get_all_categories();
    
    $this->load->view('category' , $this->data);
  }

  public function product_details()
  {
    $product_id = $this->uri->segment(3);
    $data['products'] = $this->product->get_product_details( $product_id );
    // print_r($data);
    // die();
    $this->load->view('product_details' , $data);
  }

  public function get_products_by_category()
  {
      //$type = $this->input->post('category_type');
      $category_id = $this->input->post('category_id');
      
      $all_category_products = $this->product->get_category_products($category_id);

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
      echo $data;

  }

}

