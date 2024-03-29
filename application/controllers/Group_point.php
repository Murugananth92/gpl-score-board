<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Group_point extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Group_point_model');
		verify_session();
    } 

    /*
     * Listing of group points
     */
    function index()
    {
        $data['group_points'] = $this->Group_point_model->get_all_group_points();
        
        $data['_view'] = 'group_point/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new group point
     */
    function add()
    {   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tournament_team_name','tournament Team Name','required');
		$this->form_validation->set_rules('net_run_rate','Net Run Rate','required');
		$this->form_validation->set_rules('points','Points','required|integer');
		$this->form_validation->set_rules('wins','Wins','required|integer');
		$this->form_validation->set_rules('losses','Losses','required|integer');
		$this->form_validation->set_rules('n/r','N/r','required|integer');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'group_id' => $this->input->post('group_id'),
				'tournament_team_id' => $this->input->post('tournament_team_name'),
				'net_run_rate' => $this->input->post('net_run_rate'),
				'points' => $this->input->post('points'),
				'wins' => $this->input->post('wins'),
				'losses' => $this->input->post('losses'),
				'n/r' => $this->input->post('n/r'),
            );
            
            $group_point_id = $this->Group_point_model->add_group_point($params);
            $this->session->set_flashdata('add_msg', 'The group point team is added');
            redirect('group_point/index');
        }
        else
        {
			$this->load->model('Group_model');
			$data['all_tournaments'] = $this->Group_model->get_all_tournaments();
            
            $data['all_tournament_teams'] = $this->Group_point_model->get_all_tournament_teams();
            
            $data['_view'] = 'group_point/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a group point
     */
    function edit($group_points_id)
    {   
        // check if the group_point exists before trying to edit it
        $data['group_point'] = $this->Group_point_model->get_group_point($group_points_id);
        
        if(isset($data['group_point']['group_points_id']))
        {
            $this->load->library('form_validation');

		$this->form_validation->set_rules('net_run_rate','Net Run Rate','required');
		$this->form_validation->set_rules('points','Points','required|integer');
		$this->form_validation->set_rules('wins','Wins','required|integer');
		$this->form_validation->set_rules('losses','Losses','required|integer');
		$this->form_validation->set_rules('n/r','N/r','required|integer');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'tournament_team_id' => $this->input->post('tournament_team_id'),
					'net_run_rate' => $this->input->post('net_run_rate'),
					'points' => $this->input->post('points'),
					'wins' => $this->input->post('wins'),
					'losses' => $this->input->post('losses'),
					'n/r' => $this->input->post('n/r'),
                );

                $this->Group_point_model->update_group_point($group_points_id,$params);
                $this->session->set_flashdata('edit_msg', 'The group point team has been edited');            
                redirect('group_point/index');
            }
            else
            {

				$this->load->model('Group_model');
				$data['all_tournaments'] = $this->Group_model->get_all_tournaments();

                $data['_view'] = 'group_point/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The group_point you are trying to edit does not exist.');
    } 

    /*
     * Deleting a group point
     */
    function remove($group_points_id)
    {
        $group_point = $this->Group_point_model->get_group_point($group_points_id);

        // check if the group_point exists before trying to delete it
        if(isset($group_point['group_points_id']))
        {
            $this->Group_point_model->delete_group_point($group_points_id);
            $this->session->set_flashdata('msg', 'The group team is deleted');
            redirect('group_point/index');
        }
        else
            show_error('The group_point you are trying to delete does not exist.');
    }
    
}
