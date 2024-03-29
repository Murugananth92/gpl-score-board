<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Player extends CI_Controller{
    private $user_data;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Player_model');
        $this->user_data = $this->session->userdata;
		verify_session();
    } 

    /*
     * Listing of players
     */
    function index()
    {
        $data['players'] = $this->Player_model->get_all_players();
        
        $data['_view'] = 'player/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new player
     */
    function add()
    {  
        $this->load->library('form_validation');

		$this->form_validation->set_rules('player_name','Player Name','required|max_length[150]');
		$this->form_validation->set_rules('player_email','Player Email','required|max_length[255]|valid_email');
		$this->form_validation->set_rules('company','Company','required');
		$this->form_validation->set_rules('employee_id','Employee Id','required|integer');
		$this->form_validation->set_rules('player_role','Player Role','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'player_name' => strtoupper($this->input->post('player_name')),
				'player_email' => $this->input->post('player_email'),
				'company' => $this->input->post('company'),
				'employee_id' => $this->input->post('employee_id'),
				'player_role' => $this->input->post('player_role'),
				'created_by' => $this->user_data['user_id']
            );            
            $player_id = $this->Player_model->add_player($params);
            $this->session->set_flashdata('add_msg', 'The player has been added');
            redirect('player/index');
        }
        else
        {            
            $data['_view'] = 'player/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a player
     */
    function edit($player_id)
    {   
        // check if the player exists before trying to edit it
        $data['player'] = $this->Player_model->get_player($player_id);
        
        if(isset($data['player']['player_id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('player_name','Player Name','required|max_length[150]');
			$this->form_validation->set_rules('player_email','Player Email','required|max_length[255]|valid_email');
			$this->form_validation->set_rules('company','Company','required');
			$this->form_validation->set_rules('employee_id','Employee Id','required|integer');
			$this->form_validation->set_rules('player_role','Player Role','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'player_name' => strtoupper($this->input->post('player_name')),
					'player_email' => $this->input->post('player_email'),
					'company' => $this->input->post('company'),
					'employee_id' => $this->input->post('employee_id'),
					'player_role' => $this->input->post('player_role'),
					'updated_by' => $this->user_data['user_id']
                );

                $this->Player_model->update_player($player_id,$params);  
                $this->session->set_flashdata('edit_msg', 'The player has been edited');          
                redirect('player/index');
            }
            else
            {
                $data['_view'] = 'player/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The player you are trying to edit does not exist.');
    } 

    /*
     * Deleting a player
     */
    function remove($player_id)
    {
        $player = $this->Player_model->get_player($player_id);

        // check if the player exists before trying to delete it
        if(isset($player['player_id']))
        {
            $this->Player_model->delete_player($player_id);
            $this->session->set_flashdata('msg', 'The player is deleted');
            redirect('player/index');
        }
        else
            show_error('The player you are trying to delete does not exist.');
    }
    
}
