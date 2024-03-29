<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Team extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Team_model');
		verify_session();
    } 

    /*
     * Listing of teams
     */
    function index()
    {
        $data['teams'] = $this->Team_model->get_all_teams();
        
        $data['_view'] = 'team/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new team
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('team_name','Team Name','required|max_length[150]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'team_name' => $this->input->post('team_name'),
            );
            
            $team_id = $this->Team_model->add_team($params);
            $this->session->set_flashdata('add_msg', 'The team is added');
            redirect('team/index');
        }
        else
        {            
            $data['_view'] = 'team/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a team
     */
    function edit($team_id)
    {   
        // check if the team exists before trying to edit it
        $data['team'] = $this->Team_model->get_team($team_id);
        
        if(isset($data['team']['team_id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('team_name','Team Name','required|max_length[150]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'team_name' => $this->input->post('team_name'),
                );

                $this->Team_model->update_team($team_id,$params);            
                $this->session->set_flashdata('edit_msg', 'The team details has been edited');
                redirect('team/index');
            }
            else
            {
                $data['_view'] = 'team/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The team you are trying to edit does not exist.');
    } 

    /*
     * Deleting a team
     */
    function remove($team_id)
    {
        $team = $this->Team_model->get_team($team_id);

        // check if the team exists before trying to delete it
        if(isset($team['team_id']))
        {
            $this->Team_model->delete_team($team_id);
            $this->session->set_flashdata('msg', 'The team is deleted');
            redirect('team/index');
        }
        else
            show_error('The team you are trying to delete does not exist.');
    }  
}
