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
        $this->load->model('live_score_model');

    }

    function index()
    {
        // $players=$this->input->post('players');

        // $data['team1']= array_slice($players, 0, 11);
		// $data['team2']= array_slice($players, 11, 11);
		
		$match_id = $this->session->userdata('match_id');
		$team_1 = $this->session->userdata('team1');
		$team_2 = $this->session->userdata('team2');
		// $team1_players = array_slice($players, 0, 11);
		// $team2_players = array_slice($players, 11, 11);;

		// $this->live_score_model->match_squad($match_id, $team_1, $team1_players);
		// $this->live_score_model->match_squad($match_id, $team_2, $team2_players);

		$data['team1'] = $this->live_score_model->get_players($match_id, $team_1);
		$data['team2'] = $this->live_score_model->get_players($match_id, $team_2);
		// echo "<pre>";
		// print_r($data['team1']);
		// die;

        $data['_view'] = 'scoreboard/livescore_view';
        $this->load->view('layouts/main',$data);
	}

	
}
