<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("ion_auth");
	}

	public function index()
	{
		if ($this->ion_auth->logged_in()) {
			redirect("admin");
		}
		$this->load->view("login");
	}

	public function login() {
		
		
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$remember = $this->input->post('remember_me', TRUE);
		if ($this->ion_auth->login($username,$password,$remember)) {
			$user = $this->ion_auth->user()->row();

			$sess_data = array(
				'username' => $user->username
				);
			$this->session->set_userdata($sess_data);
			$this->session->set_flashdata('message',$this->ion_auth->messages());
			redirect('admin');

		} else {
			$this->session->set_flashdata('message',"username dan password tidak dikenal");
			redirect("auth",'refresh');
		}


	}

	public function logout() {
		$this->ion_auth->logout();
		redirect('auth');
	}


}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */