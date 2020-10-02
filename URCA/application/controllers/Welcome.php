<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller{

    public function __construct() {
    parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('login_model');
    }

    public function get_current_user(){
        $username = $this->session->userdata['logged_in']['username'];
        return $user_id = $this->research_model->current_user($username);
    }

    public function dashboard(){
        $this->load->model('research_model');
        $user_id = $this->get_current_user();
        //admin
        $data['total_pub'] = $this->research_model->total_pub_count();
        $data['unreviewed_count'] = $this->research_model->unreviewed_count();
        $data['approved_count'] = $this->research_model->approved_count();
        $data['rejected_count'] = $this->research_model->rejected_count();
        //researcher
        $data['completed_count'] = $this->research_model->completed_count($user_id);
        $data['presented_count'] = $this->research_model->presented_count($user_id);
        $data['published_count'] = $this->research_model->published_count($user_id);
        $data['creative_count'] = $this->research_model->creative_count($user_id);

        // GET TOP 10 HIGHEST RESEARCH
        $data["author_data"] = $this->research_model->fetch_all_authors();
        $data['most_likes_completed'] = $this->research_model->most_likes_completed();
        $data['most_likes_presented'] = $this->research_model->most_likes_presented();
        $data['most_likes_published'] = $this->research_model->most_likes_published();
        $data['most_likes_creative'] = $this->research_model->most_likes_creative();

        $data['authors'] = $this->research_model->fetch_all_authors();

        // foreach($data['most_likes'] as $row){
        //     // if($row->publication_id)
        //     $pub_type = $this->get_publication_type($publication_id); 
        // }
        
        // FETCH TITLE BASED ON PUBLICATION TYPE
        // if($pub_type == 'Completed Research'){
        //     $data['most_likes'] = $this->research_model->most_likes_completed();
        // }elseif($pub_type == 'Presented Research'){
        //     $data['most_likes'] = $this->research_model->most_likes_presented();
        // }elseif($pub_type == 'Published Research'){
        //     $data['most_likes'] = $this->research_model->most_likes_published();
        // }else{
        //     $data['most_likes'] = $this->research_model->most_likes_creative();
        // }
        
        $this->load->view('template/header');
		$this->load->view('main/dashboard', $data);
        $this->load->view('template/footer');
    }

    public function login(){
        $this->load->view('template/header2');
        $this->load->view('guest/login');
    }

    public function registration_form() {
        $this->load->view('template/header');
        $this->load->view('urc/registration');
    }

    // Validate and store registration data in database
    public function user_registration() {
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('first_name', 'first_name', 'required');
        $this->form_validation->set_rules('middle_name', 'middle_name', 'required');
        $this->form_validation->set_rules('last_name', 'last_name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('user_type', 'user_type', 'required');
        $this->form_validation->set_rules('department', 'department', 'required');
        // $this->form_validation->set_rules('contact_number', 'contact_number', 'required|exact_length[11]');

        if ($this->form_validation->run() == FALSE) {
            $this->registration_form();
        }else {
            $data = array(
                'username' => $this->input->post('username'),
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middle_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'department' => $this->input->post('department'),
                'contact_number' => $this->input->post('contact_number'),
                'user_type' => $this->input->post('user_type')
            );
            $this->login_model->user_insert($data);
            $data['message_display'] = 'Registration Successfully !';
            $this->login($data);
        }
    }

    // Check for user login validation
    public function user_login() {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {
        if(isset($this->session->userdata['logged_in'])){
            $this->dashboard();
        }else {
            $this->login();
        }
        }else {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        );
        $result = $this->login_model->user_login($data);
            if($result == TRUE) {
                $username = $this->input->post('username');
                $result = $this->login_model->user_session($username);
                if ($result != false) {
                $session_data = array(
                    'user_id' => $result[0]->user_id,
                    'username' => $result[0]->username,
                    'user_type' => $result[0]->user_type,
                );
                // Add user data in session
                $this->session->set_userdata('logged_in', $session_data);
                $this->dashboard();
                }
            }else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('guest/login', $data);
            }        
        }    
    }
 
    public function logout() {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->login($data);
    }
}
?>