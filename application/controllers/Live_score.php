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
		$data['team2_all'] = $this->live_score_model->get_players_all($team_2);
		$data['team_playing'] = $this->live_score_model->get_playingTeam($match_id, $team_1);
		$data['batsman_record'] = $this->live_score_model->get_batsman_record($match_id);
		$data['team_score'] = $this->live_score_model->get_team_score($match_id);

		$bowler_data = $this->live_score_model->get_bowler_score($match_id);
		$bowlerOverData = $this->live_score_model->getBowlerOverDetails($bowler_data['bowler'], $bowler_data['inning_id']);
		$bowler_innings = $this->live_score_model->getBowlerInnings($bowlerOverData, $bowler_data['inning_id'], $bowler_data['bowler']);
		$data['bowler_record'] = $this->arrange_bowler_array($bowler_data, $bowler_innings);

		$current_over_records = $this->live_score_model->get_current_over_records($data['team_score']['over_id']);
		$data['current_over_records'] = $this->lastOverRecords($current_over_records);
		$current_batsman = $this->live_score_model->get_current_batsman($match_id);
		if (count($data['batsman_record']) > 0) {
			$data['on_strike_batsman'] = $this->checkCurrentBatsman($current_batsman, $data['batsman_record']);
		}
		//echo '<pre>';print_r($data);exit;
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

		//Add a record in batsman table
		$batsman1Data = array('inning_id' => $inningId, 'batsman' => $this->input->post('batsman1'));
		$batsman2Data = array('inning_id' => $inningId, 'batsman' => $this->input->post('batsman2'));
		$bat1 = $this->live_score_model->insertBatsmanInnings($batsman1Data);
		$bat2 = $this->live_score_model->insertBatsmanInnings($batsman2Data);

		//Add a record in bowler table
		$bowlerData = array('inning_id' => $inningId, 'bowler' => $this->input->post('bowler'));
		$bowl = $this->live_score_model->insertBowlerInnings($bowlerData);

		// Add a record in match_logs table
		$logData = array('match_id' => $this->session->userdata('match_id'), 'inning_id' => $inningId, 'batsman_onstrike' => $this->input->post('batsman1'),
			'batsman' => $this->input->post('batsman2'), 'bowler' => $this->input->post('bowler'));

		$this->live_score_model->insertLog($logData);

		echo json_encode(array('inning_id' => $inningId, 'over_id' => $overId, 'on_strike_batsman' => $this->input->post('batsman1'), 'batsman1' => $this->input->post('batsman1'), 'batsman2' => $this->input->post('batsman2')), true);
	}

	function insertBallRecords()
	{
		$match_id = $this->session->userdata('match_id');
		$data = $_POST;

		// Forming an array
		$ball = ['over_id' => $data['over_id'], 'ball_number' => $data['ballnumber'], 
		'bowler' => $data['bowler'], 'batsman' => $data['onstrikeid']];

		$ball['runs_scored'] = $data['runs_scored'];

		if ($data['byes'] != 0) {
			$ball['is_byes'] = 1;
			$ball['runs_scored'] = $data['byes'];
		}

		if ($data['wide'] == 1 && $data['runs_scored'] != 0) {
			$ball['is_wide'] = 1;
			$ball['is_byes'] = 1;
			$ball['runs_scored'] = $data['byes'];
		}

		if ($data['wide'] == 1 && $data['runs_scored'] == 0) {
			$ball['is_wide'] = 1;
			$ball['runs_scored'] = 0;
		}

		if ($data['noball'] == 1) {
			$ball['is_noball'] = 1;
		}

		if ($data['runout'] == 1) {
			$ball['is_runout'] = 1;
		}

		if ($data['wicket'] == 1) {
			$ball['is_wicket'] = 1;
		}

		// Inserting into ball records and returning the inserted ball_id
		$ball_id = $this->live_score_model->insert_ball_record($ball);

		// Batsman Ball Records
		if ($data['wide'] != 1) {
			$bat_ball = ['inning_id' => $data['inning_id'], 'batsman_id' => $data['onstrikeid'], 'ball_id' => $ball_id, 'runs_scored' => $data['runs_scored']];

			if ($data['runs_scored'] == 4) {
				$bat_ball['is_4'] = 1;
			}
			else if ($data['runs_scored'] == 6) {
				$bat_ball['is_6'] = 1;
			}

			if ($data['wicket'] == 1 || $data['runout'] == 1) {
				$bat_ball['is_out'] = 1;
			}

			if ($data['byes'] != 0) {
				$bat_ball['runs_scored'] = 0;
			}

			// Inserting into batsman ball records
			$this->live_score_model->insert_batsman_ball_records($bat_ball);
		}

		if ($data['ballnumber'] == 6 && $data['wide'] != 1 && $data['noball'] != 1) {
			$this->insertOverRecords($data);
		}

		$data['team_score'] = $this->live_score_model->get_team_score($match_id);

		if ($data['wicket'] == 1 || $data['runout'] == 1) {

			$get_batsman_innings = $this->live_score_model->get_batsman_innings($data['inning_id'], $data['out_batsman']);

			$batsman_inning_data = array('runs_scored' => $get_batsman_innings['runs'], 'total_4' => $get_batsman_innings['fours'], 'total_6' => $get_batsman_innings['sixes'],
				'balls_faced' => $get_batsman_innings['ball_faced'], 'is_out' => 1, 'wicket_type' => $data['wicket_type'], 'wicket_assist1' => $data['wicket_assist1'],
				'wicket_assist2' => $data['wicket_assist2'], 'bowler' => $data['bowler']);

			$this->live_score_model->update_batsman_innings($data['inning_id'], $data['out_batsman'], $batsman_inning_data);

			//insert fall of wicket
			$fall_of_wicket = array('inning_id' => $data['inning_id'], 'ball_id' => $ball_id, 'batsman' => $data['out_batsman'], 'run' => $data['team_score']['total_team_score']);
			$this->live_score_model->insert_fall_of_wickets($fall_of_wicket);

			//Insert new batsman innings
			$new_batsman = array('inning_id' => $data['inning_id'], 'batsman' => $data['new_batsman']);

			$this->live_score_model->insertBatsmanInnings($new_batsman);
		}

		$data['batsman_record'] = $this->live_score_model->get_batsman_record($match_id);


		$bowler_data = $this->live_score_model->get_bowler_score($match_id);
		$bowlerOverData = $this->live_score_model->getBowlerOverDetails($bowler_data['bowler'], $bowler_data['inning_id']);
		$bowler_innings = $this->live_score_model->getBowlerInnings($bowlerOverData, $bowler_data['inning_id'], $bowler_data['bowler']);
		$data['bowler_record'] = $this->arrange_bowler_array($bowler_data, $bowler_innings);


		$current_over_records = $this->live_score_model->get_current_over_records($data['team_score']['over_id']);
		$data['current_over_records'] = $this->lastOverRecords($current_over_records);
		$data['current_batsman'] = $this->live_score_model->get_current_batsman($match_id);
		$data['on_strike_batsman'] = $this->checkCurrentBatsman($data['current_batsman'], $data['batsman_record']);

		echo json_encode($data, true);
	}

	function checkCurrentBatsman($current_batsman, $batsman_record)
	{
		switch (true) {
			case (empty($current_batsman)):
				$on_strike = $batsman_record[0]['batsman'];
				break;
			case (($current_batsman['runs_scored'] % 2 != 0 && $current_batsman['ball_number'] == 6) ||
				($current_batsman['runs_scored'] % 2 == 0 && $current_batsman['ball_number'] != 6)):
				$on_strike = $this->batsman_strike_status($batsman_record, $current_batsman['batsman'], 'strike');
				break;
			case (($current_batsman['runs_scored'] % 2 == 0 && $current_batsman['ball_number'] == 6) ||
				($current_batsman['runs_scored'] % 2 != 0 && $current_batsman['ball_number'] != 6)):
				$on_strike = $this->batsman_strike_status($batsman_record, $current_batsman['batsman'], 'non strike');
				break;
			default:
				$on_strike = '';
		}

		return $on_strike;
	}

	function batsman_strike_status($batsman_record, $current_batsman, $status)
	{

		$strike_batsman = '';
		$batsman1 = $batsman_record[0]['batsman'];
		$batsman2 = $batsman_record[1]['batsman'];

		if (($batsman1 == $current_batsman || $batsman2 == $current_batsman) && $status == 'strike') {
			$strike_batsman = $current_batsman;
		}

		if ($batsman1 == $current_batsman && $status == 'non strike') {
			$strike_batsman = $batsman2;
		}

		if ($batsman2 == $current_batsman && $status == 'non strike') {
			$strike_batsman = $batsman1;
		}

		return $strike_batsman;
	}

	function undoBall()
	{
		$data = $_POST;
		$ball = $data['ballid'];
		$this->live_score_model->delete_ball_record($ball);

		$match_id = $this->session->userdata('match_id');

		$data['batsman_record'] = $this->live_score_model->get_batsman_record($match_id);
		$data['team_score'] = $this->live_score_model->get_team_score($match_id);

		$bowler_data = $this->live_score_model->get_bowler_score($match_id);
		$bowlerOverData = $this->live_score_model->getBowlerOverDetails($bowler_data['bowler'], $bowler_data['inning_id']);
		$bowler_innings = $this->live_score_model->getBowlerInnings($bowlerOverData, $bowler_data['inning_id'], $bowler_data['bowler']);
		$data['bowler_record'] = $this->arrange_bowler_array($bowler_data, $bowler_innings);


		$current_over_records = $this->live_score_model->get_current_over_records($data['team_score']['over_id']);
		$data['current_over_records'] = $this->lastOverRecords($current_over_records);
		$data['current_batsman'] = $this->live_score_model->get_current_batsman($match_id);
		$data['on_strike_batsman'] = $this->checkCurrentBatsman($data['current_batsman'], $data['batsman_record']);

		echo json_encode($data, true);

	}

	function insertOverRecords($data)
	{
		$over = [];
		$getOverArray = $this->live_score_model->getOver($data['over_id']);

		$over = ['wickets' => $getOverArray['wicket'], 'wides' => $getOverArray['wide'], 'byes' => $getOverArray['byes'], 'no_balls' => $getOverArray['noball'], 'dots' => $getOverArray['dots']];
		$over['runs_gave'] = $getOverArray['runs'] + $getOverArray['wide'] + $getOverArray['noball'];
		$over['extras'] = $getOverArray['wide'] + $getOverArray['noball'];
		$over['is_completed'] = 1;
		$this->live_score_model->updateOverDetails($over, $data['over_id']);

		$data = $this->live_score_model->getBowlerOverDetails($getOverArray['bowler'], $getOverArray['inning_id']);
		$bowler_innings = $this->live_score_model->getBowlerInnings($data, $getOverArray['inning_id'], $getOverArray['bowler']);
		$this->live_score_model->updateBowlerInnings($bowler_innings, $getOverArray['bowler'], $getOverArray['inning_id']);
	}

	function new_over()
	{
		$match_id = $this->session->userdata('match_id');
		$bowler = $this->input->post('bowler');
		$inning_id = $this->input->post('inning_id');
		$over = $this->live_score_model->getLastOver($inning_id);
		$totalOver = $this->live_score_model->getTotalOvers($inning_id);

		if ($totalOver['match_overs'] == $over['over_number'] && $over['is_completed'] == 1) {
			echo json_encode(array('innings_status' => 'completed', 'over_id' => 0), true);
		}

		if ($totalOver['match_overs'] != $over['over_number']) {
			$overData = array('inning_id' => $inning_id, 'over_number' => ($over['over_number'] + 1), 'bowler' => $bowler);
			$bowlerRecords = $this->live_score_model->getBowlerStatus($inning_id, $bowler);
			if (empty($bowlerRecords) > 0) {
				$bowlerData = array('inning_id' => $inning_id, 'bowler' => $bowler);
				$bowl = $this->live_score_model->insertBowlerInnings($bowlerData);
			}
			$over_id = $this->live_score_model->insertOver($overData);

			$bowler_data = $this->live_score_model->get_bowler_score($match_id);
			$bowlerOverData = $this->live_score_model->getBowlerOverDetails($bowler_data['bowler'], $bowler_data['inning_id']);
			$bowler_innings = $this->live_score_model->getBowlerInnings($bowlerOverData, $bowler_data['inning_id'], $bowler_data['bowler']);
			$bowler_record = $this->arrange_bowler_array($bowler_data, $bowler_innings);

			echo json_encode(array('over_id' => $over_id, 'innings_status' => 'progressing',
				'bowler_record' => $bowler_record), true);
		}
	}

	function arrange_bowler_array($bowler_data, $bowler_innings)
	{
		return array('bowler' => $bowler_data['bowler'], 'player_name' => $bowler_data['player_name'], 'over_number' => $bowler_innings['overs_bowled'],
			'ball_number' => $bowler_innings['balls_bowled'], 'bowler_runs_gave' => $bowler_innings['runs_gave'], 'bowler_wickets' => $bowler_innings['wickets']);
	}

	function lastOverRecords($data)
	{
		$final = [];
		$i = 0;
		foreach ($data as $d) {
			switch ($d) {
				case ($d['is_wide'] == 1 && $d['is_byes'] == 1):
					$final[$i]['runs'] = 'Wd +' . $d['runs_scored'];
					break;
				case ($d['is_wide'] == 1 && $d['is_byes'] == 0):
					$final[$i]['runs'] = 'Wd ';
					break;
				case ($d['is_noball'] == 1 && $d['is_byes'] == 1):
					$final[$i]['runs'] = 'Nb +' . $d['runs_scored'];
					break;
				case ($d['is_byes'] == 1):
					$final[$i]['runs'] = 'B +' . $d['runs_scored'];
					break;
				case (($d['is_wicket'] == 1 OR $d['is_runout'] == 1) AND $d['runs_scored'] != 0):
					$final[$i]['runs'] = 'W +' . $d['runs_scored'];
					break;
				case (($d['is_wicket'] == 1 OR $d['is_runout'] == 1) AND $d['runs_scored'] == 0):
					$final[$i]['runs'] = 'W';
					break;
				default:
					$final[$i]['runs'] = $d['runs_scored'];
			}
			$i++;
		}
		return $final;

	}
}
