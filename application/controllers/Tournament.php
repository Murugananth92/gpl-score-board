<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tournament extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tournament_model');
		verify_session();
    } 

    /*
     * Listing of tournaments
     */
    function index()
    {
        $data['tournaments'] = $this->Tournament_model->get_all_tournaments();
        $data['_view'] = 'tournament/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new tournament
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('tournament_name','Tournament Name','required|max_length[150]');
		$this->form_validation->set_rules('tournament_year','Tournament Year','required|integer');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'tournament_name' => $this->input->post('tournament_name'),
				'tournament_year' => $this->input->post('tournament_year'),
            );
            
            $tournament_id = $this->Tournament_model->add_tournament($params);
            $this->session->set_flashdata('add_msg', 'The tournament is added');
            redirect('tournament/index');
        }
        else
        {            
            $data['_view'] = 'tournament/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a tournament
     */
    function edit($tournament_id)
    {   
        
        // check if the tournament exists before trying to edit it
        $data['tournament'] = $this->Tournament_model->get_tournament($tournament_id);
        
        if(isset($data['tournament']['tournament_id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('tournament_name','Tournament Name','required|max_length[150]');
			$this->form_validation->set_rules('tournament_year','Tournament Year','required|integer');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'tournament_name' => $this->input->post('tournament_name'),
					'tournament_year' => $this->input->post('tournament_year'),
                );

                $this->Tournament_model->update_tournament($tournament_id,$params);
                $this->session->set_flashdata('edit_msg', 'The tournament details has been edited');            
                redirect('tournament/index');
            }
            else
            {
                $data['_view'] = 'tournament/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The tournament you are trying to edit does not exist.');
    } 

    /*
     * Deleting a tournament
     */
    function remove($tournament_id)
    {
        $tournament = $this->Tournament_model->get_tournament($tournament_id);

        // check if the tournament exists before trying to delete it
        if(isset($tournament['tournament_id']))
        {
            $this->Tournament_model->delete_tournament($tournament_id);
            redirect('tournament/index');
        }
        else
            show_error('The tournament you are trying to delete does not exist.');
    }
    
}
