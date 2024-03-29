<?php
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get user by user_id
     */
    function get_user($user_id)
    {
        return $this->db->get_where('users',array('user_id'=>$user_id))->row_array();
    }
        
    /*
     * Get all users
     */
    function get_all_users()
    {
        $this->db->order_by('user_id', 'desc');
        return $this->db->get_where('users',array('is_active'=>'T'))->result_array();
    }
        
    /*
     * function to add new user
     */
    function add_user($params)
    {
        $this->db->insert('users',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update user
     */
    function update_user($user_id,$params)
    {
        $this->db->where('user_id',$user_id);
        return $this->db->update('users',$params);
    }
    
    /*
     * function to delete user
     */
    function delete_user($user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->set('is_active','F');
        return $this->db->update('users');
    }
}
