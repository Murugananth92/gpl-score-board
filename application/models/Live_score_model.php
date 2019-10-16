<?php

class Live_score_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function match_squad($match_id, $team, $team_players)
	{
		foreach ($team_players as $team_player) {
			$data = array('match_id' => $match_id, 'team_id' => $team, 'player_id' => $team_player);
			$this->db->insert('match_squads', $data);
		}
	}

	function get_player_name($group_id)
	{
		return $this->db->get_where('groups', array('group_id' => $group_id))->row_array();
	}

	function get_players($match_id, $team)
	{
		$this->db->select('P.player_id as player_id, P.player_name as player_name, P.employee_id as employee_id');
		$this->db->join('players as P', 'MS.player_id = P.player_id');
		return $this->db->get_where('match_squads as MS', array('match_id =' => $match_id, 'team_id' => $team))->result_array();
	}

	function insertInnings($innings)
	{
		// Static Entries
		$innings['inning_number'] = 1;
		$innings['inning_name'] = 'First Innings';

		$this->db->insert('innings', $innings);
		return $this->db->insert_id();
	}

	function insertOver($overs)
	{
		// Static Entries
		$overs['over_number'] = 1;
		return $this->db->insert('over_records', $overs);
	}

	function get_match_status()
	{
		$this->db->select('inning_id');
		$this->db->where('match_id', $this->session->userdata('match_id'));
		$query = $this->db->get('innings');
		return $query->num_rows();
	}

	function insert_innings($data)
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

		$this->db->insert('innings', $inningsData);
		$inning_id = $this->db->insert_id();

		$overs['inning_id'] = $inning_id;
		$overs['over_number'] = 1;
		$overs['bowler'] = $this->input->post('bowler');
		$this->db->insert('over_records', $overs);
		$over_id = $this->db->insert_id();

		return array('inning_id' => $inning_id, 'over_id' => $over_id);
	}

	function get_playingTeam($match_id)
	{
		$this->db->select('T.team_name');
		$this->db->join('teams as T', 'M.toss_won = T.team_id');
		return $this->db->get_where('matches as M', array('match_id =' => $match_id))->row_array();
	}

}
