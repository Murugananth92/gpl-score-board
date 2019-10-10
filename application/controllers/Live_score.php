<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
class Live_score extends CI_Controller{
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
        $data['_view'] = 'scoreboard/livescore_view';
        $this->load->view('layouts/main',$data);
	}
}
