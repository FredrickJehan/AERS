<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class guest extends CI_Controller{
 
    public function __construct() {
    parent::__construct();
    }
    
    public function index(){
        $this->load->view('guest/header');
        $this->load->view('guest/index');
        $this->load->view('guest/footer');
    }

    public function about(){
        $this->load->view('guest/header');
        $this->load->view('guest/about');
        $this->load->view('guest/footer');
    }
}
?>