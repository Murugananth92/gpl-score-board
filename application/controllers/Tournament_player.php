<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tournament_player extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tournament_player_model');
		verify_session();
    } 

    /*
     * Listing of tournament_players
     */
    function index()
    {
        $data['tournament_players'] = $this->Tournament_player_model->get_all_tournament_players();
        
        $data['_view'] = 'tournament_player/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new tournament player
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('tournament_team_name','Tournament Team name','required|integer');
		$this->form_validation->set_rules('player_name[]','Player Name','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'tournament_team_id' => $this->input->post('tournament_team_name'),
				'player_id' => $this->input->post('player_name'),
            );

            $tournament_player_id = $this->Tournament_player_model->add_tournament_player($params);
            $this->session->set_flashdata('add_msg', 'The tournament player has been added');
            redirect('tournament_player/index');
        }
        else
        {   
			$data['all_tournament_teams'] = $this->Tournament_player_model->get_all_tournament_teams();

			$data['all_players'] = $this->Tournament_player_model->get_players();
            
            $data['_view'] = 'tournament_player/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a tournament player
     */
    function edit($tournament_players_id)
    {   
        // check if the tournament_player exists before trying to edit it
        $data['tournament_player'] = $this->Tournament_player_model->get_tournament_player($tournament_players_id);
        
        if(isset($data['tournament_player']['tournament_players_id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('tournament_team_name','Tournament Team Name','required|integer');
			$this->form_validation->set_rules('player_name','Player Name','required|integer');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'tournament_team_id' => $this->input->post('tournament_team_name'),
					'player_id' => $this->input->post('player_name'),
                );

                $this->Tournament_player_model->update_tournament_player($tournament_players_id,$params);            
                redirect('tournament_player/index');
            }
            else
            {
                $this->load->model('Tournament_team_model');
                $data['all_tournament_teams'] = $this->Tournament_team_model->get_all_tournament_teams();
    
                $data['all_players'] = $this->Tournament_player_model->get_players();
                

                $data['_view'] = 'tournament_player/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The tournament_player you are trying to edit does not exist.');
    } 

    /*
     * Deleting a tournament player
     */
    function remove($tournament_players_id)
    {
        $tournament_player = $this->Tournament_player_model->get_tournament_player($tournament_players_id);

        // check if the tournament_player exists before trying to delete it
        if(isset($tournament_player['tournament_players_id']))
        {
            $this->Tournament_player_model->delete_tournament_player($tournament_players_id);
            $this->session->set_flashdata('msg', 'The tournament player is deleted');
            redirect('tournament_player/index');
        }
        else
            show_error('The tournament_player you are trying to delete does not exist.');
    }  
}
