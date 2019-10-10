<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{
    function __construct()
    {
		parent::__construct();
		
		$user_id = $this->session->userdata('user_id');
        if(!$user_id) {
            $this->logout();
        }
    }

    function index()
    {
        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main',$data);
	}
	
	public function logout() 
	{
        $this->session->sess_destroy();
        redirect('/');
    }
}
