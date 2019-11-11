<?php
class Matches_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get all players
     */
    function get_all_matches()
    {
//        $this->db->order_by('match_id`', 'ASC');
//        $this->db->select('match_id,team_1,team_2,match_date,match_venue,T.team_name as team1,T1.team_name as team2');
//		$this->db->join('teams as T' , 'T.team_id = M.team_1');
//		$this->db->join('teams as T1' , 'T1.team_id = M.team_2');
//		return $this->db->get_where('matches as M',array('is_deleted'=>0))->result_array();
		$sql = "SELECT `match_id`, `team_1`, `team_2`, `match_date`, `match_venue`, `T`.`team_name` as `team1`, `T1`.`team_name` as `team2` ,
         CASE WHEN M.is_completed = 1 THEN 'Completed' 
         WHEN M.is_rescheduled = 1 THEN 'Rescheduled' 
         WHEN M.toss_won IS NOT NULL THEN 'In Progress' 
         WHEN M.toss_option IS NOT NULL THEN 'In Progress' 
         ELSE 'Not started' END AS match_status 
         FROM `matches` as `M` JOIN `teams` as `T` ON `T`.`team_id` = `M`.`team_1` 
         JOIN `teams` as `T1` ON `T1`.`team_id` = `M`.`team_2` 
         WHERE `is_deleted` =0 ORDER BY `match_id` ASC ";
		return $this->db->query($sql)->result_array();
    }

    function get_all_teams()
    {

        $this->db->select('TT.team_id,team_name,T1.tournament_id');
        $this->db->join('teams as T' , 'T.team_id = TT.team_id');
        $this->db->join('tournaments as T1' , 'T1.tournament_id = TT.tournament_id');
		return $this->db->get_where('tournament_teams as TT',array('T1.is_active="T"'))->result_array();
    }
        
    /*
     * function to add new player
     */
    function add_matches($params)
    {
        $this->db->insert('matches',$params);
        return $this->db->insert_id();
    }

    function get_match_details($match_id)
    {
        $this->db->select('match_id,team_1,team_2,match_date,match_venue,T.team_name as team1,T1.team_name as team2');
        $this->db->join('teams as T' , 'T.team_id = M.team_1');
        $this->db->join('teams as T1' , 'T1.team_id = M.team_2');
		return $this->db->get_where('matches as M',array('match_id'=>$match_id))->result_array();
    }
    
    /*
     * function to update player
     */
    function update_matches($match_id,$params)
    {
        $this->db->where('match_id',$match_id);
        return $this->db->update('matches',$params);
    }
    
    /*
     * function to delete player
     */
    function delete_match($match_id)
    {
        $this->db->where('match_id',$match_id);
        $this->db->set('is_deleted','1');
        return $this->db->update('matches');
    }
}
