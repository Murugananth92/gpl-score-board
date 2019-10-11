<?php
class Group_point_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get group_point by group_points_id
     */
    function get_group_point($group_points_id)
    {
        $this->db->select('group_points_id,G.group_name,points,wins,losses,n/r,group_name,T.team_name,net_run_rate,GP.tournament_team_id');
        $this->db->join('groups as G', 'G.group_id = GP.group_id');
        $this->db->join('tournament_teams as TT', 'TT.tournament_team_id = GP.tournament_team_id');
        $this->db->join('teams as T', 'T.team_id = TT.team_id');
        return $this->db->get_where('group_points as GP',array('group_points_id'=>$group_points_id))->row_array();
    }

    function get_all_tournament_teams()
    {
    
       $this->db->select('TT.tournament_team_id,T1.team_name');
       $this->db->join(' tournaments AS T','T.tournament_id = TT.tournament_id');
       $this->db->join('teams AS T1','T1.team_id = TT.team_id');
       $this->db->where(' tournament_team_id NOT IN( SELECT GP.tournament_team_id 
                        FROM group_points  as GP
                        JOIN tournament_teams as TT  ON TT.tournament_team_id = GP.tournament_team_id)
                        AND T.is_active= "T" AND TT.is_active= "T"', NULL, FALSE);
      return $this->db->get('tournament_teams as TT')->result_array();
    }
        
    /*
     * Get all group_points
     */
    function get_all_group_points()
    {

        $this->db->select('group_points_id,G.group_name,points,wins,losses,n/r,group_name,team_name,net_run_rate');
        $this->db->join('groups as G', 'G.group_id = GP.group_id');
        $this->db->join('tournament_teams as TT', 'TT.tournament_team_id = GP.tournament_team_id');
        $this->db->join('teams as T', 'T.team_id = TT.team_id');
        return $this->db->get('group_points as GP')->result_array();

    }
        
    /*
     * function to add new group_point
     */
    function add_group_point($params)
    {
        $this->db->insert('group_points',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update group_point
     */
    function update_group_point($group_points_id,$params)
    {
        $this->db->where('group_points_id',$group_points_id);
        return $this->db->update('group_points',$params);
    }
    
    /*
     * function to delete group_point
     */
    function delete_group_point($group_points_id)
    {
        return $this->db->delete('group_points',array('group_points_id'=>$group_points_id));
    }
}
