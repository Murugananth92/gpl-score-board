<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('authentication_model');
	}

	function index($error = null)
	{
		$this->load->view('authentication', $error);
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run()) {
			if ($this->input->post('email')) {
				$login = $this->input->post('email');
				$password = md5($this->input->post('password'));

				$result = $this->authentication_model->get([
					'user_email' => $login,
					'user_password' => $password
				]);

				if ($result) {
					$this->session->set_userdata(['user_id' => $result[0]['user_id'], 'user_name' => $result[0]['user_name'], 'logged_in' => 1]);
					redirect(base_url('dashboard'));
				}
				else {
					$error['error'] = "Invalid email address or password";
					$this->index($error);
				}
			}
		}
		else {
			$this->index();
		}
	}
}
