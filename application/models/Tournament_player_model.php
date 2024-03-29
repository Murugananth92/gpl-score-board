<?php
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

    function get_players()
    {
        $this->db->select('player_id,player_name,employee_id');
        $this->db->where('`player_id` NOT IN( SELECT player_id FROM tournament_players TP INNER JOIN tournament_teams as TT ON TT.tournament_team_id = TP.tournament_team_id 
        INNER JOIN tournaments as T ON T.tournament_id = TT.tournament_id AND T.is_active ="T"                              
       ) AND P.is_deleted =0', NULL, FALSE);
       return $this->db->get('players as P')->result_array();
    }
        
    /*
     * Get all tournament_players
     */
    function get_all_tournament_players()
    {
        $this->db->select('tournament_players_id,team_name,player_name,employee_id,company');
        $this->db->join('tournament_teams as TT', 'TT.tournament_team_id = TP.tournament_team_id');
        $this->db->join('tournaments as T', 'T.tournament_id = TT.tournament_id AND T.is_active = "T"');
        $this->db->join('players as P' , 'TP.player_id = P.player_id ');
        $this->db->join('teams as T1' , 'TT.team_id = T1.team_id');
        
        return $this->db->get_where('tournament_players as TP',array('TP.is_deleted'=>0))->result_array();
    }

    /*
     * Get all tournament_teams
     */
    function get_all_tournament_teams()
    {
        $this->db->select('TT.tournament_team_id,TT.team_id,T.tournament_name,T1.team_name,P.player_name as captain,P.employee_id,P1.player_name as vice_captain');
        $this->db->join('tournaments as T', 'T.tournament_id = TT.tournament_id');
        $this->db->join('teams as T1' , 'TT.team_id = T1.team_id');
        $this->db->join('players as P' , 'TT.captain = P.player_id ');
        $this->db->join('players as P1' , 'TT.vice_captain = P1.player_id ');
        $this->db->where(array('TT.is_active'=>'T','T.is_active'=>'T'));        

        return $this->db->get('tournament_teams as TT')->result_array();
    }
        
    /*
     * function to add new tournament_player
     */
    function add_tournament_player($params)
    {
        $data = [];
        foreach($params["player_id"] as $param){
            $data[] = [
                "tournament_team_id" => $params["tournament_team_id"], 
                "player_id" => $param         
            ];
        }
        $this->db->insert_batch('tournament_players', $data);
    }
    
    /*
     * function to update tournament_player
     */
    function update_tournament_player($params,$team_id)
    {
        $this->db->where('tournament_players_id',$tournament_players_id);
        return $this->db->update('tournament_players',$params);
    }
    
    /*
     * function to delete tournament_player
     */
    function delete_tournament_player($tournament_players_id)
    {   
        $this->db->where('tournament_players_id',$tournament_players_id);
        $this->db->set('is_deleted',1);
        return $this->db->update('tournament_players');
    }
}
