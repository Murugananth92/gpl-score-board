<?php
class Tournament_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tournament by tournament_id
     */
    function get_tournament($tournament_id)
    {
        return $this->db->get_where('tournaments',array('tournament_id'=>$tournament_id))->row_array();
       
    }

    public function get_active_tournament(){
        $this->db->where("is_active","T");
        return $this->db->get('tournaments')->row_array();
    }
        
    /*
     * Get all tournaments
     */
    function get_all_tournaments()
    {
        $this->db->order_by('tournament_id', 'desc');
        $this->db->select('tournament_id,tournament_name,tournament_year,is_active ,CASE WHEN is_active = "T" THEN "active" ELSE "non-active" END AS is_active', FALSE );
        return $this->db->get('tournaments')->result_array();
    }
        
    /*
     * function to add new tournament
     */
    function add_tournament($params)
    {   
        $this->db->where('is_active','T');
        $this->db->set('is_active','F');
        $this->db->update('tournaments');
         
        $this->db->insert('tournaments',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tournament
     */
    function update_tournament($tournament_id,$params)
    {
        $this->db->where('tournament_id',$tournament_id);
        return $this->db->update('tournaments',$params);
    }
    
    /*
     * function to delete tournament
     */
    function delete_tournament($tournament_id)
    {
        $this->db->where('tournament_id',$tournament_id);
        $this->db->set('is_active','F');
        return $this->db->update('tournaments');
    }
}
