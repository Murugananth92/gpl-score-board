<?php

class Start_match_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_match()
	{
		$this->db->select('M.match_id,T.team_id as teamid_1, T1.team_id as teamid_2,T.team_name as team_1, T1.team_name as team_2,TO.tournament_name,M.match_date,M.match_venue');
		$this->db->join('teams as T', 'M.team_1 = T.team_id');
		$this->db->join('teams as T1', 'M.team_2 = T1.team_id ');
		$this->db->join('tournaments as TO', 'TO.tournament_id = M.tournament_id');
		return $this->db->get('matches as M')->result_array();
	}

	function get_all_player($data)
	{
		$team_id1 = $data['teamid_1'];
		$team_id2 = $data['teamid_2'];

		$this->db->select('P.player_id, P.player_name as player_name,P.employee_id,T1.team_name as team,T1.team_id');
		$this->db->join('players as P', 'TP.player_id = P.player_id');
		$this->db->join('tournament_teams as TT', 'TT.tournament_team_id = TP.tournament_team_id');
		$this->db->join('teams as T1', 'T1.team_id = TT.team_id');
		$this->db->join('teams as T2', 'T2.team_id = TT.team_id');
		$this->db->where_in('TP.tournament_team_id', [$team_id1, $team_id2]);
		return $this->db->get('tournament_players as TP')->result_array();
	}
}
