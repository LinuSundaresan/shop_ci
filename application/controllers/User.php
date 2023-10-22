<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function signup()
	{
		$this->load->view('signup.php');
	}

	public function register(){

		$this->load->model('register_model', 'register');
		$firstname = $this->input->post('first_name');
		$lastname = $this->input->post('last_name');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		$country = $this->input->post('country');
		$password = $this->input->post('password');

		$data = array(
			'first_name' => $firstname,
			'last_name'	=> $lastname,
			'email'	    => $email,
			'address'   => $address,
			'city'      => $city,
			'country'   => $country,
			'password'  => md5($password)
		);

		$res = $this->register->save_user($data);
		echo json_encode($res);

		// if($res){
		// 	$this->session->set_flashdata('save', 'Success');
		// 	redirect("user/register");
		// }
		
	}


	public function login()
	{
		$this->load->view('login.php');
	}

	public function check_login()
	{
		$this->load->model('login_model', 'login');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$where = array(
			'username' => $username,
			'password' => $password
		);

		//$res = $this->login->get_user($where);

		if ($this->login->get_user($where)) {
			$res = $this->login->get_user($where);
			$the_session = array("login_id" => $res[0]['login_id'], "name" => $res[0]['username'] );
			$this->session->set_userdata($the_session);
            echo 'success';
        } else {
            echo 'error';
        }

	}


	public function dashboard()
	{
		if($this->session->userdata('user_id')!=""){
			//echo "You are logged in  " . $this->session->userdata('name');
			$data['username'] = $this->session->userdata('name');
			$this->load->view('dashboard.php', $data);
		}
		else{
			redirect('user/login');
		}
	}

	public function logout(){
		$the_session = array("user_id" =>"" );
		$this->session->set_userdata($the_session);
		redirect('user/dashboard');
	}
}
