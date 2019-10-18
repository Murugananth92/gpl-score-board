<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Live_score extends CI_Controller
{
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
		$toss_won = $this->session->userdata('toss_won');

		$data['team1_name'] = $this->session->userdata('team1_name');
		$data['team2_name'] = $this->session->userdata('team2_name');

		$data['team1'] = $this->live_score_model->get_players($match_id, $team_1);
		$data['team2'] = $this->live_score_model->get_players($match_id, $team_2);
		$data['team_playing'] = $this->live_score_model->get_playingTeam($match_id, $team_1);
		$data['match_details'] = $this->live_score_model->get_match_details();
		$data['is_innings_progressing'] = $this->live_score_model->get_innings();
		$data['_view'] = 'scoreboard/livescore_view';
		$this->load->view('layouts/main', $data);
	}

	function start_innings()
	{
		$inningsData = array('match_id' => $this->session->userdata('match_id'),
			'batting_team' => $this->session->userdata('team1'),
			'bowling_team' => $this->session->userdata('team2'),
			'batsman_1' => $this->input->post('batsman1'),
			'batsman_2' => $this->input->post('batsman2'),
			'bowler' => $this->input->post('bowler'),
			'inning_number' => 1,
			'inning_name' => 'First Innings'
		);

		//Add a record in innings table
		$inningId = $this->live_score_model->insert_innings($inningsData);

		//Add a record in overs table
		$overData = array('inning_id' => $inningId, 'over_number' => 1, 'bowler' => $this->input->post('bowler'));
		$overId = $this->live_score_model->insertOver($overData);

		// Add a record in match_logs table
		$logData = array('match_id' => $this->session->userdata('match_id'), 'inning_id' => $inningId, 'batsman_onstrike' => $this->input->post('batsman1'),
			'batsman' => $this->input->post('batsman2'), 'bowler' => $this->input->post('bowler'));

		$this->live_score_model->insertLog($logData);

		echo json_encode(array('inning_id' => $inningId, 'over_id' => $overId), true);
	}

	function updateBatBowl()
	{
		$match_id = $this->session->userdata('match_id');
		$team_1 = $this->session->userdata('team1');
		$team_2 = $this->session->userdata('team2');
		$batsman1 = $this->input->post('batsman1');
		$batsman2 = $this->input->post('batsman2');
		$bowler = $this->input->post('bowler');

		$innings = array('match_id' => $match_id,
			'batting_team' => $team_1,
			'bowling_team' => $team_2,
			'batsman_1' => $batsman1,
			'batsman_2' => $batsman2,
			'bowler' => $bowler);
		//Add a record in innings table
		$inning_id = $this->live_score_model->insertInnings($innings);

		//Add a record in overs table
		$overs = ['inning_id' => $inning_id, 'bowler' => $bowler];
		$result = $this->live_score_model->insertOver($overs);


		if ($result) {
			$this->index();
		}
	}


}
