<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->model('backend/Admin_model','admin');
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


}