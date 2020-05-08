<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    public function __construct() {
    parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("research_model");
    }

    public function index(){
        $this->load->view('template/header2');
        $this->load->view('guest/index');
    }

    public function about(){
        $this->load->view('template/header2');
        $this->load->view('guest/about');
        $this->load->view('template/footer2');
    }

    public function submit(){
    
        $this->load->view('template/header2');
		$this->load->view('main/submit');
		$this->load->view('template/footer2');
    }

    public function publication(){
    
        $this->load->view('template/header');
		$this->load->view('main/Publication');
		$this->load->view('template/footer');
    }

    public function rank(){
    
        $this->load->view('template/header');
		$this->load->view('main/ranking');
		$this->load->view('template/footer');
    }

    public function research(){
    
        $this->load->view('template/header');
		$this->load->view('main/research');
		$this->load->view('template/footer');
    }

    public function detailed_view(){
        $id = $this->uri->segment(2);
        $this->load->model("research_model");
        $data['home_data'] = $this->research_model->get_research_detail($id);
        $this->load->view('template/header');
        $this->load->view("main/detailed", $data);
        $this->load->view('template/footer');
    }

    public function manage(){

		$this->load->view('template/header');
		$this->load->view('main/manage');
		$this->load->view('template/footer');
    }
    
    public function edit(){
    
        $this->load->view('template/header');
		$this->load->view('main/edit');
		$this->load->view('template/footer');
    }

    public function unsubmit(){
    
        $this->load->view('template/header');
		$this->load->view('main/unsubmit');
		$this->load->view('template/footer');
    }

    public function guestform(){
    
        $this->load->view('template/header');
		$this->load->view('main/guestform');
		$this->load->view('template/footer');
    }

    public function search(){
    
        $this->load->view('template/header');
		$this->load->view('main/search');
		$this->load->view('template/footer');
    }
    
    //localhost/URCA(baseurl)/Controller(main)/Method(index)/Parameter(optional)
}