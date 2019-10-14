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
        // $this->load->model('live_score_model');

    }

    function index()
    {
        $players=$this->input->post('players');

        $data['team1']= array_slice($players, 0, 11);
        $data['team2']= array_slice($players, 11, 11);


        $data['_view'] = 'scoreboard/livescore_view';
        $this->load->view('layouts/main',$data);
	}
}
