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
		$sql = "SELECT ORS.over_number,ORS.inning_id,BRS.* FROM ball_records BRS 
				INNER JOIN over_records as ORS ON BRS.over_id = ORS.over_id
				WHERE ORS.inning_id = (SELECT inning_id FROM innings WHERE match_id = $match_id ORDER BY inning_id DESC LIMIT 1)";

		$result = $this->db->query($sql);
		$data = $result->result_array();

		$sql1 = "SELECT ORS.* FROM over_records ORS 
				WHERE ORS.inning_id = (SELECT inning_id FROM innings WHERE match_id = $match_id ORDER BY inning_id DESC LIMIT 1)
				ORDER BY ORS.over_id DESC LIMIT 1 ";

		$result1 = $this->db->query($sql1);
		$data1 = $result1->row_array();

		return $this->team_score($data, $data1);
	}

	function team_score($data, $data1)
	{
		if (empty($data)) {
			return array('total_team_score' => 0, 'wickets' => 0, 'overs' => 0, 'balls' => 0, 'ball_id' => 0, 'inning_id' => $data1['inning_id'], 'over_id' => $data1['over_id']);
		}

		$runs = $wickets = 0;
		foreach ($data as $d) {
			$runs += $d['runs_scored'] + $d['is_wide'] + $d['is_noball'];
			$wickets += $d['is_wicket'];
		}

		$last_array = end($data);
		$over_bowled = ($last_array['over_number'] - 1);
		$balls_bowled = $last_array['ball_number'];
		$ball_id = $last_array['ball_id'];
		$inning_id = $last_array['inning_id'];

		if ($last_array['ball_number'] == 6) {
			$over_bowled = $last_array['over_number'];
			$balls_bowled = 0;
		}

		return array('total_team_score' => $runs, 'wickets' => $wickets, 'overs' => $over_bowled, 'balls' => $balls_bowled,
			'ball_id' => $ball_id, 'inning_id' => $inning_id, 'over_id' => $data1['over_id']);
	}

	function get_bowler_score($match_id)
	{
		$sql = "SELECT P.player_name,ORS.* FROM over_records ORS 
				INNER JOIN players as P ON P.player_id = ORS.bowler
				WHERE ORS.inning_id = (SELECT inning_id FROM innings WHERE match_id =$match_id ORDER BY inning_id DESC LIMIT 1) ORDER BY over_id DESC LIMIT 1";

		$result = $this->db->query($sql);

		return $result->row_array();
	}

	function get_current_batsman($match_id)
	{
		$sql = "SELECT BRS.ball_number,BRS.bowler,BRS.runs_scored,BRS.batsman FROM ball_records AS BRS 
				INNER JOIN over_records AS ORS ON ORS.over_id = BRS.over_id 
				WHERE ORS.inning_id = (SELECT inning_id FROM innings WHERE match_id =$match_id ORDER BY inning_id DESC LIMIT 1) 
				ORDER BY BRS.ball_id DESC LIMIT 1";
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
		$query = "SELECT BRS.bowler,ORS.inning_id,SUM(CASE WHEN BRS.`is_byes`=0 THEN BRS.`runs_scored` ELSE 0 END) as runs,
		SUM(CASE WHEN BRS.`is_wide`=1 THEN BRS.`is_wide` ELSE 0 END) as wide,
		SUM(CASE WHEN BRS.`is_noball`=1 THEN BRS.`is_noball` ELSE 0 END) as noball,
		SUM(CASE WHEN BRS.`is_byes`=1 THEN BRS.`runs_scored` ELSE 0 END) as byes,
		SUM(CASE WHEN BRS.`is_wicket`= 1 THEN BRS.`is_wicket` ELSE 0 END) as wicket,
		(SELECT COUNT(`ball_id`) FROM `ball_records` AS BR WHERE BR.`over_id` = '" . $over_id . "' AND BR.`runs_scored`=0 AND BR.`is_wide`=0 AND BR.`is_noball`=0 GROUP BY BR.`over_id` ) as dots
		FROM `ball_records` as BRS
		INNER JOIN over_records as ORS ON ORS.over_id = BRS.over_id 
		WHERE BRS.`over_id` ='" . $over_id . "' GROUP BY BRS.`over_id`";
		return $this->db->query($query)->row_array();

	}

	function updateOverDetails($over, $over_id)
	{
		$this->db->where('over_id', $over_id);
		$this->db->update('over_records', $over);
	}

	function getLastOver($inning_id)
	{
		$sql = "SELECT * FROM over_records WHERE inning_id='" . $inning_id . "' ORDER BY over_id DESC LIMIT 1";
		$result = $this->db->query($sql);
		return $result->row_array();
	}

	function getTotalOvers($inning_id)
	{
		$this->db->select('M.match_overs');
		$this->db->join('innings as I', 'I.match_id = M.match_id');
		return $this->db->get_where('matches as M', array('inning_id =' => $inning_id))->row_array();
	}

	function get_bowler_details($over_id)
	{
		$this->db->select('P.player_name,ORS.bowler');
		$this->db->join('players as p', 'I.player_id = ORS.bowler');
		return $this->db->get_where('over_records as ORS', array('over_id =' => $over_id))->row_array();
	}

	function getBowlerOverDetails($bowler, $inning_id)
	{
		$this->db->select('BR.*');
		$this->db->join('over_records as ORS', 'BR.over_id = ORS.over_id');
		return $this->db->get_where('ball_records as BR', array('BR.bowler =' => $bowler, 'ORS.inning_id' => $inning_id))->result_array();
	}

	function getBowlerInnings($data, $inning_id, $bowler)
	{
		if (empty($data)) {
			return array('runs_gave' => 0, 'overs_bowled' => 0, 'balls_bowled' => 0, 'wickets' => 0, 'wides' => 0, 'no_balls' => 0);
		}

		$runs = $wickets = $wide = $no_ball = 0;

		foreach ($data as $d) {
			$runs += $d['runs_scored'] + $d['is_wide'] + $d['is_noball'];
			$wickets += $d['is_wicket'];
			$wide += $d['is_wide'];
			$no_ball += $d['is_noball'];
		}

		$last_array = end($data);
		$over_bowled = $this->oversBowled($inning_id, $bowler);
		$balls_bowled = $last_array['ball_number'];
		if ($last_array['ball_number'] == 6) {
			$balls_bowled = 0;
		}

		return array('runs_gave' => $runs, 'overs_bowled' => $over_bowled, 'balls_bowled' => $balls_bowled, 'wickets' => $wickets, 'wides' => $wide, 'no_balls' => $no_ball);

	}

	function oversBowled($inning_id, $bowler)
	{
		$this->db->select('(CASE WHEN is_completed =1 THEN SUM(is_completed) ELSE 0 END) as overs');
		$data = $this->db->get_where('over_records', array('inning_id =' => $inning_id, 'bowler' => $bowler))->row_array();
		return $data['overs'];
	}

	function updateBowlerInnings($data, $bowler, $inning_id)
	{
		$this->db->where('bowler', $bowler);
		$this->db->where('inning_id', $inning_id);
		$this->db->update('bowler_innings', $data);
	}

	function getBowlerStatus($inning_id, $bowler)
	{
		$this->db->select('*');
		return $this->db->get_where('bowler_innings', array('bowler =' => $bowler, 'inning_id' => $inning_id))->row_array();
	}

	function get_batsman_innings($inning_id, $batsman)
	{
		$sql = "SELECT SUM(runs_scored) as runs, SUM(is_4) as fours,SUM(is_6) as sixes,COUNT(`batsman_ball_record_id`) as ball_faced 
				FROM batsman_ball_records
				WHERE `batsman_id` ='" . $batsman . "'  AND inning_id ='" . $inning_id . "' ";

		return $this->db->query($sql)->row_array();
	}

	function update_batsman_innings($inning_id, $batsman, $data)
	{

		$this->db->where('batsman', $batsman);
		$this->db->where('inning_id', $inning_id);
		$this->db->update('batsman_innings', $data);
	}

	function insert_fall_of_wickets($data)
	{
		$this->db->insert('fall_of_wickets', $data);

	}

}
