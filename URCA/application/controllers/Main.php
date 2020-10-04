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
        $data['authors'] = $this->research_model->fetch_all_authors();
        $data['editors'] = $this->research_model->fetch_all_editors();
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
        //$data['dept'] = $this->research_model->getDepartment();
        //$data['type'] = $this->research_model->getType_Research();
        $data['search_com'] = $this->research_model->search_completed($keyword);
        $data['search_pre'] = $this->research_model->search_presented($keyword);
        $data['search_pub'] = $this->research_model->search_published($keyword);
        $data['search_cre'] = $this->research_model->search_creative($keyword);
        $data['authors'] = $this->research_model->fetch_all_authors();
        $data['editors'] = $this->research_model->fetch_all_editors();
        $data['dept'] = $this->research_model->getDept();
        $data['pub'] = $this->research_model->getPub_type();
        $data['user'] = $this->research_model->getUser();

        // if($keyword == NULL){
        //     redirect('search/'.$this->input>post('keyword'));
        // }
        $this->load->view('template/header2');
		$this->load->view('guest/search', $data);
        $this->load->view('template/footer2');
    }

    public function search_filter(){
        $department = $this->input->post('department');
        $year = $this->input->post('year');
        $type_of_research = $this->input->post('type_research');
        $faculty = $this->input->post('faculty');
        //$author = $this->input->post('auth');
        //$data['dept'] = $this->research_model->getDepartment();
        //$data['type'] = $this->research_model->getType_Research();
        $data['search_com'] = $this->research_model->search_filter_completed($department, $year, $type_of_research, $faculty);
        $data['search_pre'] = $this->research_model->search_filter_presented($department, $year, $type_of_research, $faculty);
        $data['search_pub'] = $this->research_model->search_filter_published($department, $year, $type_of_research, $faculty);
        $data['search_cre'] = $this->research_model->search_filter_creative($department, $year, $type_of_research, $faculty);
        $data['authors'] = $this->research_model->fetch_all_authors();
        $data['editors'] = $this->research_model->fetch_all_editors();
        $data['dept'] = $this->research_model->getDept();
        $data['pub'] = $this->research_model->getPub_type();
        $data['user'] = $this->research_model->getUser();

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

    public function get_publication_type($publication_id){
        return $publication_type = $this->research_model->select_publication_type($publication_id);
    }

    public function detailed_view(){
        $publication_id = $this->uri->segment(2); 
        $data['publication_type'] = $this->get_publication_type($publication_id); 
        $data["author_data"] = $this->research_model->fetch_all_authors();
        
        if($data['publication_type'] == 'Completed Research'){
            $data['research_data'] = $this->research_model->select_all_completed_view($publication_id); 
        }elseif($data['publication_type'] == 'Presented Research'){
            $data['research_data'] = $this->research_model->select_all_presented_view($publication_id);
        }elseif($data['publication_type'] == 'Published Research'){
            $data['research_data'] = $this->research_model->select_all_published_view($publication_id);
        }else{
            $data['research_data'] = $this->research_model->select_all_creative_view($publication_id);
        }
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