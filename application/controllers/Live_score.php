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

		//Working
		$data['team2all'] = $this->live_score_model->get_players_all($team_2);

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

	function insertBallRecords() {
		$data = $_POST;
		
		$ball = ['over_id'=>$data['over_id'], 'ball_number'=>$data['ball_number'], 'bowler'=>$data['bowler'], 'runs_scored'=>$data['runs_scored'], 'batsman'=>$data['batsman1']];

		if(array_key_exists('wide', $data)) {
			$ball['is_extra'] = 'T';
			$ball['extra_type'] = 'wide';
		} else if(array_key_exists('noball', $data)) {
			$ball['is_extra'] = 'T';
			$ball['extra_type'] = 'no_ball';
		} else {
			$ball['is_extra'] = 'F';
			$ball['extra_type'] = 'none';
		}

		// print_r($ball);	
		// die;
		$ball_record = $this->live_score_model->insert_ball_record($ball);
		$get_batsman_record = $this->live_score_model->get_batsman_record($match_id);
		$get_team_score = $this->live_score_model->get_team_score($match_id);
		$get_bowler_score = $this->live_score_model->get_bowler_score($match_id);
		$get_current_batsman = $this->live_score_model->get_current_batsman();

		$this->checkCurrentBatsman($get_current_batsman,$get_batsman_record);
		// echo $ball_record;
	}

	function checkCurrentBatsman($get_current_batsman,$get_batsman_record) {
		
		$strike="";
		if($get_current_batsman['ball_number']==6)
		{
			if($get_current_batsman['runs_scored']%2==0)
			{
				$this->test($get_batsman_record,$get_current_batsman['batsman'],'0');
			}
			else{
				$this->test($get_batsman_record,$get_current_batsman['batsman'],'1');
			}
		}
		else{
			if($get_current_batsman['runs_scored']%2==0)
			{
				$this->test($get_batsman_record,$get_current_batsman['batsman'],'1');
			}
			else{
				$this->test($get_batsman_record,$get_current_batsman['batsman'],'0');
			}
		}
		
	}

	function test($batsman_data,$current_batsman,$status)
	{
		$final=[];
		foreach($batsman_data as $key => $data)
		{
			$final[$key]=$data;
			// $final[$key]['is_onstrike']='1';
			if($data['batsman_id']==$current_batsman && $status == '1')
			{
				$final[$key]['is_onstrike']='1';
			}
			else if($data['batsman_id']!=$current_batsman && $status == '0')
			{
				$final[$key]['is_onstrike']='0';
			}
		}
		print_r($final);
		die;
	}

	function undoBall() {
		$data = $_POST;
		$ball = $data['ballid'];
		$this->live_score_model->delete_ball_record($ball);
	}




}
