<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Player_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get player by player_id
     */
    function get_player($player_id)
    {
        return $this->db->get_where('players',array('player_id'=>$player_id))->row_array();
    }
        
    /*
     * Get all players
     */
    function get_all_players()
    {
        $this->db->order_by('player_id', 'desc');
        return $this->db->get('players')->result_array();
    }
        
    /*
     * function to add new player
     */
    function add_player($params)
    {
        $this->db->insert('players',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update player
     */
    function update_player($player_id,$params)
    {
        $this->db->where('player_id',$player_id);
        return $this->db->update('players',$params);
    }
    
    /*
     * function to delete player
     */
    function delete_player($player_id)
    {
        return $this->db->delete('players',array('player_id'=>$player_id));
    }
}
