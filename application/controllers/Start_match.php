<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start_match extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Start_match_model');
		verify_session();
	}

	function index($match_id)
	{
		$this->load->model('matches_model');
		$data['matches'] = $this->matches_model->get_match_details($match_id);
		$data['params'] = [];
		if ($this->input->post('matches') != null) {
			$data['params'] = $this->getMatchDetails($_POST);
			$data['params'] = 1;
		}
		$data['_view'] = 'scoreboard/startmatch_view';
		$this->load->view('layouts/main', $data);
	}

	function select_players()
	{
		$data['teamid_1'] = $this->input->post('teamId1');
		$data['teamid_2'] = $this->input->post('teamId2');

		$team1_name = $this->Start_match_model->get_team_name($data['teamid_1'])->team_name;
		$team2_name = $this->Start_match_model->get_team_name($data['teamid_2'])->team_name;

		$team1 = $this->Start_match_model->get_all_player($data['teamid_1']);
		$team2 = $this->Start_match_model->get_all_player($data['teamid_2']);
		$players = array();
		$players[$team1_name] = $team1;
		$players[$team2_name] = $team2;
		echo json_encode($players, TRUE);
	}


	function select_players_old()
	{
		$data['params'] = [];
		$this->form_validation->set_rules('matches', 'Match', 'required');
		$this->form_validation->set_rules('team1', '	Team 1', 'required');
		$this->form_validation->set_rules('team2', '	Team 2', 'required');
		$this->form_validation->set_rules('match_date', 'Match Date', 'required');
		$this->form_validation->set_rules('match_venue', 'Match Venue', 'required');
		$this->form_validation->set_rules('team1_toss', 'Team Toss', 'required');
		$this->form_validation->set_rules('toss_options', 'Toss Options', 'required');
		$this->form_validation->set_rules('overs', 'Overs', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['matches'] = $this->Start_match_model->get_all_match();
			$data['_view'] = 'scoreboard/startmatch_view';
			$this->load->view('layouts/main', $data);
		}
		else {
			$data['params'] = $this->getMatchDetails($_POST);

			if ($data['params']) {

				$match_no = $data['params']['matches'];
				$params_value = array('toss_won' => $data['params']['team1_toss'],
					'toss_option' => $data['params']['toss_options'],
					'match_overs' => $data['params']['overs']);

				$this->Start_match_model->team_toss_update($params_value, $match_no);

				$players = $this->Start_match_model->get_all_player($data['params']);
				$data['players'] = $this->arrangePlayers($players);
				$data['_view'] = 'scoreboard/selectplayer_view';
				$this->load->view('layouts/main', $data);
			}
		}
	}

	public function arrangePlayers($players)
	{
		$final = [];
		foreach ($players as $player) {
			$final[$player['team']][] = $player;
		}
		return $final;
	}

	public function getMatchDetails($post)
	{

		$team_id = $this->Start_match_model->get_team_id($post['team1_toss']);
		return array('matches' => $post['matches'], 'team1' => $post['team1'], 'team2' => $post['team2'],
			'teamid_1' => $post['teamid_1'], 'teamid_2' => $post['teamid_2'], 'match_date' => $post['match_date'],
			'match_venue' => $post['match_venue'], 'team1_toss' => $post['team1_toss'], 'toss_options' => $post['toss_options'],
			'overs' => $post['overs']);

	}

	public function add_squad()
	{
		$this->load->model('live_score_model');
		$match_id = $this->input->post('matches');
		$team_1 = $this->input->post('teamid_1');
		$team_2 = $this->input->post('teamid_2');
		$players = $this->input->post('players');
		$params_value = array('toss_won' => $this->input->post('team1_toss'),
			'toss_option' => $this->input->post('toss_options'),
			'match_overs' => $this->input->post('overs'));


		$this->Start_match_model->team_toss_update($params_value, $match_id);
		$team1_name = $this->Start_match_model->get_team_name($team_1)->team_name;
		$team2_name = $this->Start_match_model->get_team_name($team_2)->team_name;
		$team1_players = array_slice($players, 0, 11);
		$team2_players = array_slice($players, 11, 11);

		$this->live_score_model->match_squad($match_id, $team_1, $team1_players);
		$this->live_score_model->match_squad($match_id, $team_2, $team2_players);

		redirect('Live_score/index/' . $match_id);
	}

}


