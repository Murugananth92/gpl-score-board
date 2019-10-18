<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Matches extends CI_Controller{
    // private $user_data;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Matches_model');
        $this->user_data = $this->session->userdata; 
    } 

    /*
     * Listing of players
     */
    function index()
    {
        $data['matches'] = $this->Matches_model->get_all_matches();
        
        $data['_view'] = 'matches/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new player
     */
    function add()
    {  
        $this->load->library('form_validation');

		$this->form_validation->set_rules('team_1','Team Name','required|max_length[150]');
		$this->form_validation->set_rules('team_2','Team Name','required|max_length[255]');
		$this->form_validation->set_rules('match_date','Date','required');
		$this->form_validation->set_rules('match_venue','match venue','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'tournament_id' => $this->input->post('tournament_id'),
				'team_1' => $this->input->post('team_1'),
				'team_2' => $this->input->post('team_2'),
				'match_date' => $this->input->post('match_date'),
				'match_venue' => $this->input->post('match_venue')
            ); 
            
            // echo"<pre>";
            // print_r($params);
            // die;
            $matches = $this->Matches_model->add_matches($params);
            $this->session->set_flashdata('add_msg', 'The player has been added');
            redirect('matches/index');
        }
        else
        {   
            $data['all_teams'] = $this->Matches_model->get_all_teams();

            $data['_view'] = 'matches/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a player
     */
    function edit($match_id)
    {  
        
        // echo $match_id;
        // die;
        // check if the player exists before trying to edit it
        // $data['player'] = $this->Player_model->get_player($player_id);
        
        // if(isset($data['player']['player_id']))
        // {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('team_1','Team Name','required|max_length[150]');
            $this->form_validation->set_rules('team_2','Team Name','required|max_length[255]');
            $this->form_validation->set_rules('match_date','Date','required');
            $this->form_validation->set_rules('match_venue','match venue','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
				'team_1' => $this->input->post('team_1'),
				'team_2' => $this->input->post('team_2'),
				'match_date' => $this->input->post('match_date'),
				'match_venue' => $this->input->post('match_venue')
                );

                $this->Matches_model->update_matches($match_id,$params);  
                $this->session->set_flashdata('edit_msg', 'The player has been edited');          
                redirect('matches/index');
            }
            else
            {
                $data['all_teams'] = $this->Matches_model->get_all_teams();

                $data['all_matches'] = $this->Matches_model->get_match_details($match_id);

                $data['_view'] = 'matches/edit';
                $this->load->view('layouts/main',$data);
            }
        // }
        // else
        //     show_error('The player you are trying to edit does not exist.');
    } 

    /*
     * Deleting a player
     */
    function delete($match_id)
    {
        // $player = $this->Player_model->get_player($player_id);

        // check if the player exists before trying to delete it
        // if(isset($player['player_id']))
        // {
            $this->Matches_model->delete_match($match_id);
            $this->session->set_flashdata('msg', 'The player is deleted');
            redirect('matches/index');
    //     }
    //     else
    //         show_error('The player you are trying to delete does not exist.');
    }
    
}
