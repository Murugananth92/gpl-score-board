<?php
 
class Live_score extends CI_Controller{
    function __construct()
    {
		parent::__construct();
		
		$user_id = $this->session->userdata('user_id');
        if(!$user_id) {
            $this->logout();
        }
        // $this->load->model('dashboard_model');
        
    }

    function index()
    {
        $data['_view'] = 'livescore_view';
        $this->load->view('layouts/main',$data);
	}
	
	public function logout() 
	{
        $this->session->sess_destroy();
        redirect('/');
    }
}
