<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tournament_team extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tournament_team_model');
		verify_session();
    } 

    /*
     * Listing of tournament_teams
     */
    function index()
    {
        $data['tournament_teams'] = $this->Tournament_team_model->get_all_tournament_teams();
        
        $data['_view'] = 'tournament_team/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new tournament team
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('tournament_name','Tournament Name','required|integer');
		$this->form_validation->set_rules('team_name','Team Name','required|integer');
		$this->form_validation->set_rules('captain','Captain','required');
		$this->form_validation->set_rules('vice_captain','Vice Captain','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'tournament_id' => $this->input->post('tournament_name'),
				'team_id' => $this->input->post('team_name'),
				'captain' => $this->input->post('captain'),
				'vice_captain' => $this->input->post('vice_captain'),
            );
      
            $tournament_team_id = $this->Tournament_team_model->add_tournament_team($params);
            $this->session->set_flashdata('add_msg', 'The tournament team is added');
            redirect('tournament_team/index');
        }
        else
        {  
            $this->load->model('Tournament_model');
			$data['active_tournament'] = $this->Tournament_model->get_active_tournament();


            $data['all_teams'] = $this->Tournament_team_model->get_all_teams();
            
			$data['all_players'] = $this->Tournament_team_model->get_captains();

            
            $data['_view'] = 'tournament_team/add';
            $this->load->view('layouts/main',$data);

        }
    }  

    /*
     * Editing a tournament team
     */
    function edit($tournament_team_id)
    {   
       
        // check if the tournament_team exists before trying to edit it
        $data['tournament_team'] = $this->Tournament_team_model->get_tournament_team($tournament_team_id);
        if(isset($data['tournament_team']['tournament_team_id']))
        {
          
            $this->load->library('form_validation');

			$this->form_validation->set_rules('tournament_name','Tournament Name','required|integer');
			$this->form_validation->set_rules('captain','Captain','required|integer');
			$this->form_validation->set_rules('vice_captain','Vice Captain','required|integer');
		
			if($this->form_validation->run())     
            {   
                
                $params = array(
					'tournament_id' => $this->input->post('tournament_name'),
					'team_id' => $this->input->post('team_id'),
					'captain' => $this->input->post('captain'),
					'vice_captain' => $this->input->post('vice_captain'),
                );


                 $this->Tournament_team_model->update_tournament_team($tournament_team_id,$params);
                 $this->session->set_flashdata('edit_msg', 'The tournament team detail has been edited');
                redirect('tournament_team/index');
            }
            else
            {

                $this->load->model('Tournament_model');
                $data['active_tournament'] = $this->Tournament_model->get_active_tournament();


                $data['all_teams'] = $this->Tournament_team_model->get_all_teams();
                
                $data['all_players'] = $this->Tournament_team_model->captains_edit($tournament_team_id);


                $data['_view'] = 'tournament_team/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The tournament_team you are trying to edit does not exist.');
    } 

    /*
     * Deleting a tournament team
     */
    function remove($tournament_team_id)
    {
        $tournament_team = $this->Tournament_team_model->get_tournament_team($tournament_team_id);

        // check if the tournament_team exists before trying to delete it
        if(isset($tournament_team['tournament_team_id']))
        {
            $this->Tournament_team_model->delete_tournament_team($tournament_team_id);
            $this->session->set_flashdata('msg', 'The tournament team is deleted');
            redirect('tournament_team/index');
        }
        else
            show_error('The tournament_team you are trying to delete does not exist.');
    }

   
}
