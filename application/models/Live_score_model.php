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

	//Working 
	function get_players_all($team)
	{
		$this->db->select('P.player_id as player_id, P.player_name as player_name, P.employee_id as employee_id');
		$this->db->join('players as P', 'TP.player_id = P.player_id');
		return $this->db->get_where('tournament_players as TP', array('tournament_team_id' => $team))->result_array();
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

	function insert_ball_record($ball)
	{
		$this->db->insert('ball_records', $ball);
		return $this->db->insert_id();
	}

	function get_batsman_record($match_id)
	{
		$sql = "SELECT BI.batsman, P.player_name,count(BBR.ball_id) AS balls, SUM(BBR.is_6) AS total_6, SUM(BBR.is_4) AS total_4, SUM(BBR.runs_scored) AS runs 
		FROM batsman_innings AS BI
		INNER JOIN players as P ON P.player_id = BI.batsman
		LEFT JOIN batsman_ball_records AS BBR ON BI.inning_id = BBR.inning_id AND BI.batsman = BBR.batsman_id
		WHERE BI.`inning_id` = (SELECT inning_id FROM innings WHERE match_id = $match_id ORDER BY inning_id DESC LIMIT 1) 
		AND BI.is_out = 0  AND BI.is_retired = 0 
		GROUP BY BI.batsman";

		$result = $this->db->query($sql);

		return $result->result_array();
	}

	function get_team_score($match_id)
	{
		$sql = "SELECT I.inning_id,ORS.over_id,BR.ball_id,sum(BR.runs_scored) AS total_team_score,ORS.wickets AS wickets,(MAX(ORS.over_number)-1) AS overs,(SELECT ball_number FROM ball_records ORDER BY ball_id DESC LIMIT 1) as balls 
				FROM `over_records` AS ORS 
				INNER JOIN innings AS I ON I.inning_id = ORS.inning_id 
				LEFT JOIN ball_records AS BR ON ORS.over_id = BR.over_id 
				WHERE I.`match_id` = $match_id
				GROUP BY I.`match_id` ORDER BY ORS.over_id DESC LIMIT 1";

		$result = $this->db->query($sql);

		return $result->row_array();
	}

	function get_bowler_score($match_id)
	{
		$sql = "SELECT P.player_name,(ORS.over_number-1) as over_number,MAX(BR.ball_number) as ball_number,ORS.bowler,sum(BR.runs_scored) AS bowler_runs_gave,ORS.wickets AS bowler_wickets
		FROM `over_records` AS ORS 
		INNER JOIN players as P ON P.player_id = ORS.bowler
		LEFT JOIN ball_records AS BR ON ORS.over_id = BR.over_id
		INNER JOIN innings AS I ON I.inning_id = ORS.inning_id
		WHERE I.`match_id` = $match_id AND ORS.over_id = (SELECT over_id FROM over_records ORDER BY over_id DESC LIMIT 1)
		GROUP BY ORS.bowler";

		$result = $this->db->query($sql);

		return $result->row_array();
	}

	function get_current_batsman()
	{
		$sql = "SELECT ball_number,bowler,runs_scored,batsman FROM ball_records ORDER BY ball_id DESC LIMIT 1";

		$result = $this->db->query($sql);

		return $result->row_array();
	}

	/**
	 * @param $over_id
	 * @return mixed
	 */
	function get_current_over_records($over_id)
	{
		$sql = "SELECT `runs_scored`,`is_wide`,`is_noball`,`is_byes`,`is_wicket`,`is_runout` FROM ball_records WHERE over_id = '" . $over_id . "' ";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	function insertBatsmanInnings($batsmanData)
	{
		$this->db->insert('batsman_innings', $batsmanData);
		return $this->db->insert_id();
	}

	function insertBowlerInnings($bowlerData)
	{
		$this->db->insert('bowler_innings', $bowlerData);
		return $this->db->insert_id();
	}
	// function getInningsID($match_id)
	// {
	// 	$this->db->select('I.inning_id');
	// 	return $this->db->get_where('innings as I', array('match_id =' => $match_id))->row()->inning_id;
	// }
	function delete_ball_record($ball)
	{
		$this->db->where('ball_id', $ball);
		$this->db->delete('ball_records');
		$this->db->where('ball_id', $ball);
		$this->db->delete('batsman_ball_records');
	}

	function insert_batsman_ball_records($bat_ball)
	{
		$this->db->insert('batsman_ball_records', $bat_ball);
		return $this->db->insert_id();
	}

	function getOver($over_id)
	{
		$query = "SELECT SUM(CASE WHEN `is_byes`=0 THEN `runs_scored` ELSE 0 END) as runs,
		SUM(CASE WHEN `is_wide`=1 THEN `is_wide` ELSE 0 END) as wide,
		SUM(CASE WHEN `is_noball`=1 THEN `is_noball` ELSE 0 END) as noball,
		SUM(CASE WHEN `is_byes`=1 THEN `runs_scored` ELSE 0 END) as byes,
		SUM(CASE WHEN `is_wicket`= 1 THEN `is_wicket` ELSE 0 END) as wicket,
		(SELECT COUNT(`ball_id`) FROM `ball_records` AS BR WHERE BR.`over_id` = 14 AND BR.`runs_scored`=0 AND BR.`is_wide`=0 AND BR.`is_noball`=0 GROUP BY BR.`over_id` ) as dots 
		FROM `ball_records` WHERE `over_id` ='" . $over_id . "' GROUP BY `over_id`";
		return $this->db->query($query)->row_array();

	}

	function updateOverDetails($over, $over_id)
	{
		$this->db->where('over_id', $over_id);
		$this->db->update('over_records', $over);
	}


}
