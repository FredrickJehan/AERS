<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    public function __construct() {
    parent::__construct();
        $this->load->helper('form');
        $this->load->helper('array');
        $this->load->library('form_validation');
        $this->load->model("research_model");
    }

    public function index(){
        $data['recent_com'] = $this->research_model->select_all_completed_recent();
        $data['recent_pre'] = $this->research_model->select_all_presented_recent();
        $data['recent_pub'] = $this->research_model->select_all_published_recent();
        $data['recent_cre'] = $this->research_model->select_all_creative_recent();
        $this->load->view('template/header2');
        $this->load->view('guest/index', $data);
    }

    public function about(){
        $this->load->view('template/header2');
        $this->load->view('guest/about');
        $this->load->view('template/footer2');
    }

    public function search(){
        $keyword = $this->input->post('keyword', true);
        $data['dept'] = $this->research_model->getDepartment();
        $data['type'] = $this->research_model->getType_Research();
        $data['search_com'] = $this->research_model->search_completed($keyword);
        $data['search_pre'] = $this->research_model->search_presented($keyword);
        $data['search_pub'] = $this->research_model->search_published($keyword);
        $data['search_cre'] = $this->research_model->search_creative($keyword);
        // if($keyword == NULL){
        //     redirect('search/'.$this->input>post('keyword'));
        // }
        $this->load->view('template/header2');
		$this->load->view('guest/search', $data);
        $this->load->view('template/footer2');
    }

    public function search_filter(){
        $department = $this->input->post('department', true);
        $year = $this->input->post('year', true);
        $type_of_research = $this->input->post('type_research', true);
        //$data['dept'] = $this->research_model->getDepartment();
        //$data['type'] = $this->research_model->getType_Research();
        $data['search_com'] = $this->research_model->search_filter_completed($department, $year, $type_of_research);
        $data['search_pre'] = $this->research_model->search_filter_presented($department, $year, $type_of_research);
        $data['search_pub'] = $this->research_model->search_filter_published($department, $year, $type_of_research);
        $data['search_cre'] = $this->research_model->search_filter_creative($department, $year, $type_of_research);
        $this->load->view('template/header2');
		$this->load->view('guest/search', $data);
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

    public function research(){
    
        $this->load->view('template/header');
		$this->load->view('main/research');
		$this->load->view('template/footer');
    }

    public function detailed_view(){
        $id = $this->uri->segment(2);
        $data['research_detailed'] = $this->research_model->select_all_completed_view($id);
        $this->load->view('template/header2');
        $this->load->view("guest/detailed", $data);
        $this->load->view('template/footer2');
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
    
    //localhost/URCA(baseurl)/Controller(main)/Method(index)/Parameter(optional)
}