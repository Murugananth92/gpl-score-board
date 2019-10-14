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
    function get_player_name($group_id)
    {
        return $this->db->get_where('groups',array('group_id'=>$group_id))->row_array();
    }

}
?>