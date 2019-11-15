<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Group extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Group_model');
		verify_session();
    } 

    /*
     * Listing of groups
     */
    function index()
    {
        $data['groups'] = $this->Group_model->get_all_groups();
        
        $data['_view'] = 'group/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new group
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('group_name','Group Name','required|max_length[255]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'group_name' => $this->input->post('group_name'),
				'tournament_id' => $this->input->post('tournament_id')
            );

            
            $group_id = $this->Group_model->add_group($params);
            $this->session->set_flashdata('add_msg', 'The group is added');
            redirect('group/index');
        }
        else
        {  
            
            $data['all_tournaments'] = $this->Group_model->get_all_tournaments();
            
            $data['_view'] = 'group/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a group
     */
    function edit($group_id)
    {   
        // check if the group exists before trying to edit it
        $data['group'] = $this->Group_model->get_group($group_id);
        
        if(isset($data['group']['group_id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('group_name','Group Name','required|max_length[255]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'group_name' => $this->input->post('group_name'),
					'tournament_id' => $this->input->post('tournament_id'),
                );

                $this->Group_model->update_group($group_id,$params);  
                $this->session->set_flashdata('edit_msg', 'The group has been edited');          
                redirect('group/index');
            }
            else
            {
                $data['all_tournaments'] = $this->Group_model->get_all_tournaments();
            
                $data['_view'] = 'group/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The group you are trying to edit does not exist.');
    } 

    /*
     * Deleting a group
     */
    function remove($group_id)
    {
        $group = $this->Group_model->get_group($group_id);

        // check if the group exists before trying to delete it
        if(isset($group['group_id']))
        {
            $this->Group_model->delete_group($group_id);
            $this->session->set_flashdata('msg', 'The group is deleted');
            redirect('group/index');
        }
        else
            show_error('The group you are trying to delete does not exist.');
    }
    
}
