<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Start_match extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$user_id = $this->session->userdata('user_id');
		if (!$user_id) {
			$this->logout();
		}
		$this->load->model('Start_match_model');

	}

	function index()
	{
		$data['params'] = [];
		if ($this->input->post('matches') != null) {
			
			
			$data['params'] = $this->getMatchDetails($_POST);
			$data['params'] =  1;

		}
		$data['matches'] = $this->Start_match_model->get_all_match();
		$data['_view'] = 'scoreboard/startmatch_view';
		$this->load->view('layouts/main', $data);
	}

	function select_players()
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

				$match_no=$data['params']['matches'];
				$params_value=array('toss_won' => $data['params']['team1_toss'],
									'toss_option' => $data['params']['toss_options'],
									'match_overs' => $data['params']['overs']);

				// $match_array = array('match_id'=>$match_no, 'team1'=>$data['params']['teamid_1'],'team2'=>$data['params']['teamid_2']); 
				// $this->session->set_userdata($match_array);
	
				$this->Start_match_model->team_toss_update($params_value,$match_no);

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

	public function add_squad() {

		$this->load->model('live_score_model');

		$match_id = $this->input->post('matches');
		$team_1 = $this->input->post('teamid_1');
		$team_2 = $this->input->post('teamid_2');

		// echo "<pre>";
		// print_r($data[params)};
		// die;
		$players=$this->input->post('players');

		// $match_id = $this->session->userdata('match_id');
		// $team_1 = $this->session->userdata('team1');
		// $team_2 = $this->session->userdata('team2');
		$team1_players = array_slice($players, 0, 11);
		$team2_players = array_slice($players, 11, 11);

		$this->live_score_model->match_squad($match_id, $team_1, $team1_players);
		$this->live_score_model->match_squad($match_id, $team_2, $team2_players);

		$data['team1'] = $this->live_score_model->get_players($match_id, $team_1);
		$data['team2'] = $this->live_score_model->get_players($match_id, $team_2);

		$match_array = array('match_id'=>$match_id, 'team1'=>$team_1,'team2'=>$team_2); 
		$this->session->set_userdata($match_array);
		// echo "<pre>";
		// print_r($data['team1']);
		// die;
		redirect(Live_score);
        // $data['_view'] = 'scoreboard/livescore_view';
        // $this->load->view('layouts/main',$data);
	}

}


