<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
class Live_score extends CI_Controller{
    function __construct()
    {
		parent::__construct();
		
        $this->load->model('live_score_model');

    }

    function index()
    {	
		$match_id = $this->session->userdata('match_id');
		$team_1 = $this->session->userdata('team1');
		$team_2 = $this->session->userdata('team2');

		$data['team1'] = $this->live_score_model->get_players($match_id, $team_1);
		$data['team2'] = $this->live_score_model->get_players($match_id, $team_2);

        $data['_view'] = 'scoreboard/livescore_view';
        $this->load->view('layouts/main',$data);
	}

	function updateBatBowl() 
	{
		$match_id = $this->session->userdata('match_id');
		$team_1 = $this->session->userdata('team1');
		$team_2 = $this->session->userdata('team2');
		$batsman1 = $this->input->post('batsman1');
		$batsman2 = $this->input->post('batsman2');
		$bowler = $this->input->post('bowler');	

		$innings=array('match_id' => $match_id,
							'batting_team' => $team_1,
							'bowling_team' => $team_2,
							'batsman_1' => $batsman1,
							'batsman_2' => $batsman2,
							'bowler' => $bowler); 

		$inning_id = $this->live_score_model->insertInnings($innings);
		$overs = ['inning_id' => $inning_id, 'bowler' => $bowler];
		$result = $this->live_score_model->insertOver($overs);

		if($result)
		{
			$this->index();
		}
	}

	
}
