<?php

class Start_match_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	function get_all_match()
	{
		$this->db->select('M.match_id,T.team_name as team_1, T1.team_name as team_2,TO.tournament_name,M.match_date,M.match_venue');
		$this->db->join('teams as T', 'M.team_1 = T.team_id');
		$this->db->join('teams as T1', 'M.team_2 = T1.team_id ');
		$this->db->join('tournaments as TO', 'TO.tournament_id = M.tournament_id');
		return $this->db->get('matches as M')->result_array();
	}
}

?>
