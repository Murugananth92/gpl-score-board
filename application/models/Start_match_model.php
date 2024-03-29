<?php

class Start_match_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_match_detail()
	{
		$this->db->select('M.match_id,T.team_id as teamid_1, T1.team_id as teamid_2,T.team_name as team_1, T1.team_name as team_2,TO.tournament_name,M.match_date,M.match_venue');
		$this->db->join('teams as T', 'M.team_1 = T.team_id');
		$this->db->join('teams as T1', 'M.team_2 = T1.team_id ');
		$this->db->join('tournaments as TO', 'TO.tournament_id = M.tournament_id');
		return $this->db->get_where('matches as M', array('is_completed =' => 0))->result_array();
	}

	function get_all_match()
	{
		$this->db->select('M.match_id,T.team_id as teamid_1, T1.team_id as teamid_2,T.team_name as team_1, T1.team_name as team_2,TO.tournament_name,M.match_date,M.match_venue');
		$this->db->join('teams as T', 'M.team_1 = T.team_id');
		$this->db->join('teams as T1', 'M.team_2 = T1.team_id ');
		$this->db->join('tournaments as TO', 'TO.tournament_id = M.tournament_id');
		return $this->db->get_where('matches as M', array('is_completed =' => 0))->result_array();
	}

	function get_all_player($team_id)
	{
		$this->db->select('P.player_id, P.player_name as player_name,P.employee_id,T1.team_name as team,T1.team_id');
		$this->db->join('players as P', 'TP.player_id = P.player_id');
		$this->db->join('tournament_teams as TT', 'TT.tournament_team_id = TP.tournament_team_id');
		$this->db->join('teams as T1', 'T1.team_id = TT.team_id');
		$this->db->join('teams as T2', 'T2.team_id = TT.team_id');
		$this->db->where('TP.tournament_team_id', $team_id);
		return $this->db->get('tournament_players as TP')->result_array();
	}

	function get_team_id($team)
	{
		$this->db->select('team_id');
		return $this->db->get_where('teams', array('team_name =' => $team))->row();
	}

	function get_team_name($team_id)
	{
		$this->db->select('team_name');
		return $this->db->get_where('teams', array('team_id =' => $team_id))->row();
	}

	function team_toss_update($params_value,$match_no)
	{
				$team = $params_value['toss_won'];
				$team_id = $this->get_team_id($team)->team_id;
				$toss_option = $params_value['toss_option'];
				$match_overs = $params_value['match_overs'];

				$data = array('toss_won'=>$team_id,'toss_option'=>$toss_option,'match_overs'=>$match_overs);

				$this->db->where('match_id',$match_no);
				return $this->db->update('matches',$data);
	}
}
