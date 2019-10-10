<?php
class Tournament_team_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tournament_team by tournament_team_id
     */
    function get_tournament_team($tournament_team_id)
    {
        $this->db->select('TT.tournament_team_id,TT.team_id,T.team_name,P1.player_name as captain,P2.player_name as vice_captain,P1.player_id as captain_id,P2.player_id as vice_captain_id');
        $this->db->join('teams as T' , 'T.team_id = TT.team_id');
        $this->db->join('players as P1' ,'P1.player_id = TT.captain');
        $this->db->join('players as P2' , 'P2.player_id = TT.vice_captain');
        $this->db->where('tournament_team_id', $tournament_team_id);

        return $this->db->get('tournament_teams as TT')->row_array();
    }


    function get_players()
    {
        $this->db->select('player_id,player_name,employee_id');
        $this->db->where('player_id NOT IN ( SELECT player_id FROM tournament_players TP 
        INNER JOIN tournament_teams as TT ON TT.tournament_team_id = TP.tournament_team_id 
        INNER JOIN tournaments as T ON T.tournament_id = TT.tournament_id AND T.is_active ="T"                              
       )', NULL, FALSE);
       return $this->db->get('players as P')->result_array();
    }


    function get_all_teams()
    {
        $this->db->select('team_id,team_name');
        $this->db->where('team_id NOT IN( SELECT T1.team_id FROM teams T1 
        INNER JOIN tournament_teams as TT ON TT.team_id = T1.team_id 
        INNER JOIN tournaments as T ON T.tournament_id = TT.tournament_id AND T.is_active ="T"                              
       ) AND is_active = "T"', NULL, FALSE);
       return $this->db->get('teams as T')->result_array();
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
        $this->db->where(array('TT.is_active'=>'T'));        

        return $this->db->get('tournament_teams as TT')->result_array();
    }
        
    /*
     * function to add new tournament_team
     */
    function add_tournament_team($params)
    {
        $this->db->insert('tournament_teams',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tournament_team
     */
    function update_tournament_team($tournament_team_id,$params)
    {
        $this->db->where('tournament_team_id',$tournament_team_id);
        return $this->db->update('tournament_teams',$params);

    }

    /*
     * function to delete tournament_team
     */
    function delete_tournament_team($tournament_team_id)
    {
        $this->db->where('tournament_team_id',$tournament_team_id);
        $this->db->set('is_active','F');
        return $this->db->update('tournament_teams');
    }

    function get_captains(){
        $this->db->select('player_id,player_name,employee_id');
        $this->db->where('player_id NOT IN ( SELECT captain FROM tournament_teams TT 
        INNER JOIN tournaments as T ON T.tournament_id = TT.tournament_id AND T.is_active = "T"  )', NULL, FALSE);
        $this->db->where('player_id NOT IN ( SELECT vice_captain FROM tournament_teams TT 
        INNER JOIN tournaments as T ON T.tournament_id = TT.tournament_id AND T.is_active = "T"  ) AND P.is_deleted = 0', NULL, FALSE);
        return $this->db->get('players as P')->result_array();
    }

    function captains_edit($tournament_team_id){
        $this->db->select('player_id,player_name,employee_id');
        $this->db->where('player_id NOT IN ( SELECT captain FROM tournament_teams TT 
        INNER JOIN tournaments as T ON T.tournament_id = TT.tournament_id AND T.is_active = "T" AND TT.tournament_team_id !='.$tournament_team_id.')', NULL, FALSE);
        $this->db->where('player_id NOT IN ( SELECT vice_captain FROM tournament_teams TT 
        INNER JOIN tournaments as T ON T.tournament_id = TT.tournament_id AND T.is_active = "T" AND TT.tournament_team_id !='.$tournament_team_id.' )  AND P.is_deleted = 0', NULL, FALSE);
        return $this->db->get('players as P')->result_array();
    }
}
