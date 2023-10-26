<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->model('backend/Admin_model','admin');
      $this->load->model('backend/Product_model','product');
      $this->load->library('pagination');

  }

  public function categories()
  {
    if($this->session->userdata('admin_login_id')!=""){
        $this->load->view('backend/pages/categories');
    }
    else{
        redirect('admin/login');
    }
  }

  public function get_all_categories(){
    
    $this->load->library('pagination');
    $config['base_url'] = base_url().'backend/products/categories';
    $config['first_url'] = 1;
    $config['total_rows'] = $this->product->get_all_categories_count();
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
    $all_categories = $this->product->get_all_categories($rowperpage, $offset );
    $pagination_links = $this->pagination->create_links();
    $data = "";

    foreach($all_categories as $category)
    {
        $data.=  '<tr>
        <td><input type="checkbox" name="select" class="select_multiple dt-checkboxes form-check-input" /></td>
        <td>'.$category['category_name'].'</td>
        <td>
        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
            <li
            data-bs-toggle="tooltip"
            data-popup="tooltip-custom"
            data-bs-placement="top"
            class="avatar avatar-xs pull-up"
            title="Lilian Fuller"
            >
            <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
            </li>
            <li
            data-bs-toggle="tooltip"
            data-popup="tooltip-custom"
            data-bs-placement="top"
            class="avatar avatar-xs pull-up"
            title="Sophia Wilkerson"
            >
            <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
            </li>
            <li
            data-bs-toggle="tooltip"
            data-popup="tooltip-custom"
            data-bs-placement="top"
            class="avatar avatar-xs pull-up"
            title="Christina Parker"
            >
            <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
            </li>
        </ul>
        </td>
        <td><span class="badge bg-label-primary me-1">Active</span></td>
        <td>
            <div class="d-flex align-items-sm-center justify-content-sm-center">
                <button class="btn btn-sm btn-icon delete-record me-2" fdprocessedid="bp7e3l"><i class="bx bx-trash"></i></button>
                <button class="btn btn-sm btn-icon" fdprocessedid="vmme5"><i class="bx bx-edit"></i></button>
            </div>
        </td>
    </tr>';
  }
    $response = array(
        'categories' => $data,
        'pagination' => $pagination_links
    );

    echo json_encode($response);
}


}