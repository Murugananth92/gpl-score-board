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
		$data['bowler_record'] = $this->live_score_model->get_bowler_score($match_id);
		$current_over_records = $this->live_score_model->get_current_over_records($data['team_score']['over_id']);
		$data['current_over_records'] = $this->lastOverRecords($current_over_records);
		$data['current_batsman'] = $this->live_score_model->get_current_batsman();
		if (count($data['batsman_record']) > 0) {
			$data['on_strike_batsman'] = $this->checkCurrentBatsman($data['current_batsman'], $data['batsman_record']);
		}
		$data['is_innings_progressing'] = $this->live_score_model->get_innings();
		$data['_view'] = 'scoreboard/livescore_view';
//		echo '<pre>';
//		print_r($data);
//		exit;
		$this->load->view('layouts/main', $data);
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
		$ball = ['over_id' => $data['over_id'], 'ball_number' => $data['ballnumber'], 'bowler' => $data['bowler'], 'batsman' => $data['onstrikeid']];

		if (array_key_exists('byes', $data)) {
			$ball['is_byes'] = 1;
			$ball['runs_scored'] = $data['byes'];
		}
		else {
			$ball['runs_scored'] = $data['runs_scored'];
		}

		if (array_key_exists('wide', $data)) {
			$ball['is_wide'] = 1;
			$ball['runs_scored'] = $data['byes'];
		}

		if (array_key_exists('noball', $data)) {
			$ball['is_noball'] = 1;
		}

		if (array_key_exists('runout', $data)) {
			$ball['is_runout'] = 1;
		}
		else if (array_key_exists('wicket', $data)) {
			$ball['is_wicket'] = 1;
		}

		// Inserting into ball records and returning the inserted ball_id
		$ball_id = $this->live_score_model->insert_ball_record($ball);

		// Batsman Ball Records
		if (!array_key_exists('wide', $data)) {

			$bat_ball = ['inning_id' => $data['inning_id'], 'batsman_id' => $data['onstrikeid'], 'ball_id' => $ball_id, 'runs_scored' => $data['runs_scored']];

			if ($data['runs_scored'] == 4) {
				$bat_ball['is_4'] = 1;
			}
			else if ($data['runs_scored'] == 6) {
				$bat_ball['is_6'] = 1;
			}

			if (array_key_exists('wicket', $data) || array_key_exists('runout', $data)) {
				$bat_ball['is_out'] = 1;
			}

			// Inserting into batsman ball records
			$this->live_score_model->insert_batsman_ball_records($bat_ball);

			// $batsmanInnings = [];
		}

		// if($ball['ballnumber'] == 6 && !array_key_exists('wide', $data) && !array_key_exists('noball', $data)) {

		// 	$this->insertOverRecords($data);
		// }

		$data['batsman_record'] = $this->live_score_model->get_batsman_record($match_id);
		$data['team_score'] = $this->live_score_model->get_team_score($match_id);
		$data['bowler_record'] = $this->live_score_model->get_bowler_score($match_id);
		$current_over_records = $this->live_score_model->get_current_over_records($data['team_score']['over_id']);
		$data['current_over_records'] = $this->lastOverRecords($current_over_records);
		$data['current_batsman'] = $this->live_score_model->get_current_batsman();
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
	}

	function insertOverRecords()
	{
		$over = [];
		$getOverArray = $this->live_score_model->getOver($data['over_id']);

		$over = ['wickets' => $getOverArray['wicket'], 'wides' => $getOverArray['wide'], 'byes' => $getOverArray['byes'], 'no_balls' => $getOverArray['noball'], 'dots' => $getOverArray['dots']];
		$over['runs_gave'] = $getOverArray['runs'] + $getOverArray['wide'] + $getOverArray['noball'];
		$over['extras'] = $getOverArray['wide'] + $getOverArray['noball'];
		$this->live_score_model->updateOverDetails($over, $data['over_id']);

	}
}
