<?php
class Group_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get group by group_id
     */
    function get_group($group_id)
    {
        return $this->db->get_where('groups',array('group_id'=>$group_id))->row_array();
    }

    
    function get_all_tournaments()
    {
        $this->db->select('tournament_name,tournament_id');
        return $this->db->get_where('tournaments as T','is_active="T"')->result_array();

    }
        
    /*
     * Get all groups
     */
    function get_all_groups()
    {
        $this->db->select('group_id,group_name,tournament_name');
        $this->db->join('tournaments as T', 'T.tournament_id = G.tournament_id');
        return $this->db->get('groups as G')->result_array();
    }
        
    /*
     * function to add new group
     */
    function add_group($params)
    {
        $this->db->insert('groups',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update group
     */
    function update_group($group_id,$params)
    {
        $this->db->where('group_id',$group_id);
        return $this->db->update('groups',$params);
    }
    
    /*
     * function to delete group
     */
    function delete_group($group_id)
    {
        return $this->db->delete('groups',array('group_id'=>$group_id));
    }
}
