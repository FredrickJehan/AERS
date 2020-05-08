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

    public function dashboard(){
        $this->load->view('template/header');
		$this->load->view('main/dashboard');
        $this->load->view('template/footer');
    }

    public function login(){
        $this->load->view('template/header2');
        $this->load->view('guest/login');
    }

    public function registration_form() {
        $this->load->view('template/header2');
        $this->load->view('guest/registration');
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

        $user_type = $this->input->post('user_type');
        if($user_type == "0"){
            $this->form_validation->set_rules('department', 'department', 'required');
            $this->form_validation->set_rules('contact_number', 'contact_number', 'required|exact_length[11]');
        }
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
                'user_type' => $this->input->post('user_type')
            );
            $this->login_model->user_insert($data);
            $last_id = $this->db->insert_id();
            if($user_type == "0"){
                $data2 = array(
                    'department' => $this->input->post('department'),
                    'contact_number' => $this->input->post('contact_number'),
                    'user_id' => $last_id
                );
                $this->login_model->researcher_insert($data2);
            }else if($user_type == "1"){
                $data3 = array(
                    'user_id' => $last_id
                );
                $this->login_model->admin_insert($data3);
            }
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