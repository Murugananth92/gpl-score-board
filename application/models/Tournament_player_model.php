<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Tournament_player_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tournament_player by tournament_players_id
     */
    function get_tournament_player($tournament_players_id)
    {
        return $this->db->get_where('tournament_players',array('tournament_players_id'=>$tournament_players_id))->row_array();
        
    }
        
    /*
     * Get all tournament_players
     */
    function get_all_tournament_players()
    {
        // $this->db->order_by('tournament_players_id', 'desc');
        // return $this->db->get('tournament_players')->result_array();


        $this->db->select('tournament_players_id,team_name,player_name');
        $this->db->join('tournament_teams as TT', 'TT.team_id = TP.tournament_team_id');
        $this->db->join('players as P' , 'TP.player_id = P.player_id ');
        $this->db->join('teams as T1' , 'TT.team_id = T1.team_id');
        
        return $this->db->get('tournament_players as TP')->result_array();
    }
        
    /*
     * function to add new tournament_player
     */
    function add_tournament_player($params)
    {
        $this->db->insert('tournament_players',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tournament_player
     */
    function update_tournament_player($tournament_players_id,$params)
    {
        $this->db->where('tournament_players_id',$tournament_players_id);
        return $this->db->update('tournament_players',$params);
    }
    
    /*
     * function to delete tournament_player
     */
    function delete_tournament_player($tournament_players_id)
    {
        return $this->db->delete('tournament_players',array('tournament_players_id'=>$tournament_players_id));
    }
}
