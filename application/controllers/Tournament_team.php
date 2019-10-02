<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Tournament_team extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tournament_team_model');
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
     * Adding a new tournament_team
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
            redirect('tournament_team/index');
        }
        else
        {  
            $this->load->model('Tournament_model');
			$data['all_tournaments'] = $this->Tournament_model->get_all_tournaments();

			$this->load->model('Team_model');
            // $data['all_teams'] = $this->Team_model->get_all_teams();
            $data['all_teams'] = $this->Tournament_team_model->get_all_teams();
            
			$data['all_players'] = $this->Tournament_team_model->get_players();

            
            $data['_view'] = 'tournament_team/add';
            $this->load->view('layouts/main',$data);

        }
    }  

    /*
     * Editing a tournament_team
     */
    function edit($tournament_team_id)
    {   
        // check if the tournament_team exists before trying to edit it
        $data['tournament_team'] = $this->Tournament_team_model->get_tournament_team($tournament_team_id);
        
        if(isset($data['tournament_team']['tournament_team_id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('tournament_name','Tournament Name','required|integer');
			$this->form_validation->set_rules('team_name','Team Name','required|integer');
			$this->form_validation->set_rules('captain','Captain','required|integer');
			$this->form_validation->set_rules('vice_captain','Vice Captain','required|integer');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'tournament_id' => $this->input->post('tournament_name'),
					'team_id' => $this->input->post('team_name'),
					'captain' => $this->input->post('captain'),
					'vice_captain' => $this->input->post('vice_captain'),
                );

                $this->Tournament_team_model->update_tournament_team($tournament_team_id,$params);            
                redirect('tournament_team/index');
            }
            else
            {
                $this->load->model('Tournament_model');
                $data['all_tournaments'] = $this->Tournament_model->get_all_tournaments();

                $this->load->model('Team_model');
                $data['all_teams'] = $this->Team_model->get_all_teams();

                // $this->load->model('Player_model');
                // $data['all_players'] = $this->Player_model->get_all_players();


                $data['_view'] = 'tournament_team/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The tournament_team you are trying to edit does not exist.');
    } 

    /*
     * Deleting tournament_team
     */
    function remove($tournament_team_id)
    {
        $tournament_team = $this->Tournament_team_model->get_tournament_team($tournament_team_id);

        // check if the tournament_team exists before trying to delete it
        if(isset($tournament_team['tournament_team_id']))
        {
            $this->Tournament_team_model->delete_tournament_team($tournament_team_id);
            redirect('tournament_team/index');
        }
        else
            show_error('The tournament_team you are trying to delete does not exist.');
    }
    
}
