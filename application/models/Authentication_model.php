<?php

class Authentication_model extends CI_Model 
{
	public function get($user_id = null) 
	{
		if($user_id === null) 
		{
			$query = $this -> db-> get('users');
		}
		elseif(is_array($user_id))
		{
			$query = $this -> db-> get_where('users', $user_id);
		}
		else
		{
			$query = $this -> db-> get_where('users', ['user_id' => $user_id]);
		}
		return $query->result_array();
    }
}
?>
