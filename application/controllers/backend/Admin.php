<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->model('backend/Admin_model','admin');
    //   $this->load->model('Category_model','admin/category');
  }

  public function login(){
    $this->load->view('backend/pages/auth_login');
  }

  public function check_login(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $where = array(
        'admin_username' => $username,
        'admin_password' => $password
    );

    if ($this->admin->get_user($where)) {
        $res = $this->admin->get_user($where);
        $the_session = array("admin_login_id" => $res[0]['admin_login_id'], "name" => $res[0]['admin_username'] );
        $this->session->set_userdata($the_session);
        echo 'success';
    } else {
        echo 'error';
    }
  }

  public function dashboard(){
    if($this->session->userdata('admin_login_id')==''){
        redirect('admin/login');
    }
    $this->load->view('backend/pages/dashboard');
  }

  public function logout(){
    $this->session->sess_destroy();
    redirect('admin/login');
  }


}