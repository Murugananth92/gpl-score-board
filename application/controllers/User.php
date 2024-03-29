<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
		verify_session();
    } 

    /*
     * Listing of users
     */
    function index()
    {
        $data['users'] = $this->User_model->get_all_users();
        
        $data['_view'] = 'user/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new user
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('user_password','User Password','required|max_length[255]');
		$this->form_validation->set_rules('user_name','User Name','required|max_length[100]');
		$this->form_validation->set_rules('user_email','User Email','required|max_length[255]|valid_email');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'user_password' => $this->input->post('user_password'),
				'user_name' => $this->input->post('user_name'),
				'user_email' => $this->input->post('user_email'),
				'is_active' => $this->input->post('is_active'),
            );
            
            $user_id = $this->User_model->add_user($params);
            redirect('user/index');
        }
        else
        {            
            $data['_view'] = 'user/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a user
     */
    function edit($user_id)
    {   
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($user_id);
        
        if(isset($data['user']['user_id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('user_password','User Password','required|max_length[255]');
			$this->form_validation->set_rules('user_name','User Name','required|max_length[100]');
			$this->form_validation->set_rules('user_email','User Email','required|max_length[255]|valid_email');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'user_password' => $this->input->post('user_password'),
					'user_name' => $this->input->post('user_name'),
					'user_email' => $this->input->post('user_email'),
					'is_active' => $this->input->post('is_active')
                );

                $this->User_model->update_user($user_id,$params);            
                redirect('user/index');
            }
            else
            {
                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The user you are trying to edit does not exist.');
    } 

    /*
     * Deleting a user
     */
    function remove($user_id)
    {
        $user = $this->User_model->get_user($user_id);

        // check if the user exists before trying to delete it
        if(isset($user['user_id']))
        {
            $this->User_model->delete_user($user_id);
            $this->session->set_flashdata('msg', 'The user is deleted');
            redirect('user/index');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }
    
}
