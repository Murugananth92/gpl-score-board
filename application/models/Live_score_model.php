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

	function get_match_details()
	{
		$this->db->select('T.team_name as team1,T1.team_name as team2,P.player_name as strike_batsman, P1.player_name as batsman,
						   P2.player_name as bowler,ML.over,ML.ball,ML.runs,ML.wickets');
		$this->db->join('match_logs as ML', 'M.match_id = ML.match_id');
		$this->db->join('tournament_teams as TT', 'M.team_1 = TT.team_id');
		$this->db->join('tournament_teams as TT1', 'M.team_2 = TT1.team_id');
		$this->db->join('teams as T', 'T.team_id = TT1.team_id');
		$this->db->join('teams as T1', 'T1.team_id = TT.team_id');
		$this->db->join('tournament_players as TP', 'TP.player_id = ML.batsman_onstrike');
		$this->db->join('tournament_players as TP1', 'TP1.player_id = ML.batsman');
		$this->db->join('tournament_players as TP2', 'TP2.player_id = ML.bowler');
		$this->db->join('players as P', 'P.player_id = TP.player_id');
		$this->db->join('players as P1', 'P1.player_id = TP1.player_id');
		$this->db->join('players as P2', 'P2.player_id = TP2.player_id');
		$this->db->where('ML.match_id', $this->session->userdata('match_id'));
		return $this->db->get('matches as M')->row_array();
	}

	function insert_innings($inningsData)
	{
		$this->db->insert('innings', $inningsData);
		return $this->db->insert_id();
	}

	function insertOver($overData)
	{
		$this->db->insert('over_records', $overData);
		return $this->db->insert_id();
	}

	function insertLog($logData)
	{
		$this->db->insert('match_logs', $logData);
	}

	function get_playingTeam($match_id, $team_1)
	{
		$this->db->select('T.team_name');
		$this->db->join('teams as T', 'T.team_id =' . $team_1);
		return $this->db->get_where('matches as M', array('match_id =' => $match_id))->row_array();
	}

	function get_innings()
	{
		$this->db->where('match_id', $this->session->userdata('match_id'));
		$this->db->order_by("inning_id", "desc");
		$data = $this->db->get('innings')->row_array();

		switch (true) {
			case empty($data):
				$status = 0;
				break;
			case (!empty($data) AND $data['is_completed'] == 0):
				$status = 1;
				break;
			default:
				$status = 0;
		}
		
		return $status;
	}

	function insert_ball_record($ball_record)
	{
		$aaa = $this->db->insert('ball_records', $ball_record);
		echo $aaa;
	}


}
