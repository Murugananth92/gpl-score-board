<?php
class Team_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get team by team_id
     */
    function get_team($team_id)
    {
        return $this->db->get_where('teams',array('team_id'=>$team_id))->row_array();
    }
        
    /*
     * Get all teams
     */
    function get_all_teams()
    {
        $this->db->order_by('team_id', 'desc');
        return $this->db->get_where('teams',array('is_active'=>'T'))->result_array();
    }
        
    /*
     * function to add new team
     */
    function add_team($params)
    {
        $this->db->insert('teams',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update team
     */
    function update_team($team_id,$params)
    {
        $this->db->where('team_id',$team_id);
        return $this->db->update('teams',$params);
    }
    
    /*
     * function to delete team
     */
    function delete_team($team_id)
    {
        $this->db->where('team_id',$team_id);
        $this->db->set('is_active','F');
        $this->db->update('teams');
    }
}
