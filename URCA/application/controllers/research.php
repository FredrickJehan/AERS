<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Research extends CI_Controller{
    
    public function __construct(){
    parent::__construct();
        $this->load->model('research_model');
        $this->load->library('form_validation');
        $this->load->library('user_agent');
    }

    public function test(){
        // if ($this->agent->is_referral()){
        //     echo $this->agent->referrer();
        // }
    }

    //get research id of the user who is logged in, (the one who will submit research)
    public function get_researcher_id(){
        $username = $this->session->userdata['logged_in']['username'];
        return $researcher_id = $this->research_model->select_researcher_id($username);
    }

    public function get_publication_type($publication_id){
        return $publication_type = $this->research_model->select_publication_type($publication_id);
    }


    public function research_form(){
        $this->load->view('template/header');
		$this->load->view('research/research_form');
        $this->load->view('template/footer');
    }

    public function publication(){
        $researcher_id = $this->get_researcher_id();
        $data["completed_research"] = $this->research_model->select_all_completed($researcher_id);
        $this->load->view('template/header');
		$this->load->view('research/publication', $data);
        $this->load->view('template/footer');
    }

    public function search(){
        $output = '';
        $query = '';
        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->research_model->search_completed($query);
        $data2 = $this->research_model->search_presented($query);
        $output .='
            <div class="table-responsive">
                <table class="table table-borderless">
        ';
        if($data->num_rows() > 0 || $data2->num_rows() > 0){
            foreach($data->result() as $row){
                if(!empty($row->url)){
                $output .='
                    <tr>
                        <td>
                        <a href="'. base_url('research/view/'.$row->publication_id).'"
                        '.$row->last_name.', '.substr($row->first_name, 0, 1).'. '.$row->middle_initial.'('.$row->year.'). 
                        <i>'.$row->title.'</i>(Master\'s / Doctorial dissertation). '.$row->location.': '.$row->institution.'.
                        Retrieved from '.$row->url.'
                        </a>
                        </td>
                    <tr>
                ';      
                }else{
                $output .='
                    <tr>
                        <td>
                        <a href="'. base_url('research/view/'.$row->publication_id).'"
                        '.$row->last_name.', '.substr($row->first_name, 0, 1).'. '.$row->middle_initial.'('.$row->year.'). 
                        <i>'.$row->title.'</i>(Master\'s / Doctorial dissertation). '.$row->location.': '.$row->institution.'.
                        </a>
                        </td>
                    <tr>
                ';    
                }
                
            }
            foreach($data2->result() as $row){
                $output .='
                <tr>
                    <td>
                    <a href="'. base_url('research/view/'.$row->publication_id).'"
                    '.$row->last_name.', '.substr($row->first_name, 0, 1).'. '.$row->middle_initial.'('.$row->date_presentation.'). 
                    <i>'.$row->title_presented.'</i>. '.$row->title_conference.': '.$row->place_conference.'.
                    </a>
                    </td>
                </tr>
                ';
            }
        }else{
        $output .='
            <tr>
                <td colspan="5">No Data Found</td>
            </tr>
        ';
        }
        $output .='</table>';
        echo $output;
    }

    public function research_table(){
        $researcher_id = $this->get_researcher_id();
        $data["completed_research"] = $this->research_model->select_all_completed($researcher_id);
        $data["presented_research"] = $this->research_model->select_all_presented($researcher_id);
        
        // foreach($completed_research as $row){
        //     $data['thesis'] = $row->last_name;
        //     $data['technical'] = $row->last_name;
        // }

        $this->load->view('template/header');
		$this->load->view('research/research_table', $data);
        $this->load->view('template/footer');
    }

    public function delete(){
        $publication_id = $this->uri->segment(3);
        $this->research_model->publication_delete($publication_id);
        redirect(base_url() . "research");
    }

    public function research_view(){
        $publication_id = $this->uri->segment(3); 
        $data['publication_type'] = $this->get_publication_type($publication_id); 
        
        if($data['publication_type'] == '1'){
            $data['research_data'] = $this->research_model->select_all_completed_view($publication_id); 
        }else if($data['publication_type'] == '2'){
            $data['research_data'] = $this->research_model->select_all_presented_view($publication_id);
        }else if($data['publication_type'] == '3'){
            $data['research_data'] = $this->research_model->select_all_published($publication_id);
        }else{
            $data['research_data'] = $this->research_model->select_all_creative_work($publication_id);
        }
        $this->load->view("template/header");
        $this->load->view("research/view", $data);
        // $this->load->view("template/footer");

        $data['comment_data'] = $this->research_model->comment_display($publication_id);
        $this->load->view("research/comment", $data);
        // $this->load->view("template/footer");
    }

    public function comment(){
        $publication_id = $this->uri->segment(3);
        $this->form_validation->set_rules('comment', 'comment', 'required');
        
        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            date_default_timezone_set('Asia/Karachi');
            $now = date('Y-m-d H:i:s');
            if(form_validation)
            $data = array(
                'publication_id' => $publication_id,
                'user_id' => $this->session->userdata['logged_in']['user_id'],
                'message' => $this->input->post('comment'),
                'time_created' => $now
            );
            $this->research_model->comment_insert($data);
        }
        redirect('research/view/'.$publication_id);
    }

    public function edit(){
        $publication_id = $this->uri->segment(3); 
        $data['publication_type'] = $this->get_publication_type($publication_id); 
        
        if($data['publication_type'] == '1'){
            $data['research_data'] = $this->research_model->select_all_completed_view($publication_id); 
        }else if($data['publication_type'] == '2'){
            $data['research_data'] = $this->research_model->select_all_presented_view($publication_id);
        }else if($data['publication_type'] == '3'){
            $data['research_data'] = $this->research_model->select_all_published($publication_id);
        }else{
            $data['research_data'] = $this->research_model->select_all_creative_work($publication_id);
        }

        $this->load->view("template/header");
        $this->load->view("research/edit", $data);
        $this->load->view("template/footer");    
    }

    public function upload_file(){
        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf|jpg';
        $config['max_size'] = 0;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file')){
            redirect(base_url() . "research/add");
            //add error when pdf is not uploaded
        }else{
            //$oldfile = $newfile ($upload['file_name'];
            $upload = $this->upload->data();
            $file = $upload['file_name'];
            return $file;
        }
    }

    public function author_publication_data(){
        $research_type = $this->input->post('research_type');

        if($research_type == '1' || $research_type == '2'){
            $publication_type = '1';
        }else if($research_type = '3' || $research_type == '4'){
            $publication_type = '2';
        }else if($research_type = '5' || $research_type == '6' || $research_type == '7' || $research_type == '8'){
            $publication_type = '3';
        }else{
            $publication_type = '4';
        }

        $file = $this->upload_file();
        //data for publication
        $data = array(
            'file' => $file,
            'num_views' => '0',
            'status' => '0',
            'publication_type' => $publication_type
        );
        $this->research_model->publication_insert($data);
        $last_id = $this->db->insert_id();

        //insert to author table
        $first_name = $this->input->post('first_name');
        $middle_initial = $this->input->post('middle_initial');
        $last_name = $this->input->post('last_name');

        for($i = 0; $i < count($first_name); $i++){
            $data1 = array(
                'publication_id' => $last_id,
                'researcher_id' => $this->get_researcher_id(),
                'first_name' => $first_name[$i],
                'middle_initial' => $middle_initial[$i],
                'last_name' => $last_name[$i],
                'is_employee' => '1'
            );
            $this->research_model->author_insert($data1);
        }
        return $last_id;
    }

    public function author_publication_update($publication_id){
        $file = $this->upload_file();
        //data for publication
        $data = array(
            'file' => $file
        );
        $this->research_model->publication_update($data, $publication_id);
        //data for author

        $first_name = $this->input->post('first_name');
        $middle_initial = $this->input->post('middle_initial');
        $last_name = $this->input->post('last_name');

        // for($i = 0; $i < count($first_name); $i++){
        //     $author = array(
        //         'publication_id' => $publication_id,
        //         'researcher_id' => $this->get_researcher_id(),
        //         'first_name' => $first_name[$i],
        //         'middle_initial' => $middle_initial[$i],
        //         'last_name' => $last_name[$i],
        //         'is_employee' => '1'
        //     );
        //     $this->research_model->author_update($author, $publication_id);
        // }
            $author = array(
                'publication_id' => $publication_id,
                'researcher_id' => $this->get_researcher_id(),
                'first_name' => $first_name,
                'middle_initial' => $middle_initial,
                'last_name' => $last_name,
                'is_employee' => '1'
            );
            $this->research_model->author_update($author, $publication_id);
    }

    public function completed_submit(){
        //from completed
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
        $this->form_validation->set_rules('institution', 'institution', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        //from author
        // $this->form_validation->set_rules('first_name', 'first_name', 'required');
        // $this->form_validation->set_rules('middle_initial', 'middle_initial', 'required');
        // $this->form_validation->set_rules('last_name', 'last_name', 'required');
  
        $research_type = $this->input->post('research_type');
        if($research_type == '1'){
            $this->form_validation->set_rules('url', 'url', 'required');
        }

        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $last_id = $this->author_publication_data();
            //data for completed
            $data2 = array(
                'title' => $this->input->post('title'),
                'year' => $this->input->post('year'),
                'institution' => $this->input->post('institution'),
                'location' => $this->input->post('location'),
                'url' => $this->input->post('url'),
                'completed_type' => $research_type,
                'publication_id' => $last_id
            );
            //if upate
            $this->research_model->completed_insert($data2);
            redirect(base_url() . "research");
        } 
    }

    public function completed_update(){
        //from completed
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('year', 'year', 'required');
        $this->form_validation->set_rules('institution', 'institution', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        //from author
        // $this->form_validation->set_rules('first_name', 'first_name', 'required');
        // $this->form_validation->set_rules('middle_initial', 'middle_initial', 'required');
        // $this->form_validation->set_rules('last_name', 'last_name', 'required');
  
        $research_type = $this->input->post('research_type');
        if($research_type == '1'){
            $this->form_validation->set_rules('url', 'url', 'required');
        }

        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $publication_id = $this->uri->segment(3);
            $this->author_publication_update($publication_id);
            //data for completed
            $data2 = array(
                'title' => $this->input->post('title'),
                'year' => $this->input->post('year'),
                'institution' => $this->input->post('institution'),
                'location' => $this->input->post('location'),
                'url' => $this->input->post('url'),
                'completed_type' => $research_type,
                'publication_id' => $publication_id
            );
            $this->research_model->completed_update($data2, $publication_id);
            redirect(base_url() . "research");
        }
    }

    public function presented_submit(){
        //from presented
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('month_year', 'month_year', 'required');
        $this->form_validation->set_rules('title_conference', 'title_conference', 'required');
        $this->form_validation->set_rules('place_conference', 'place_conference', 'required');
        //from author
        // $this->form_validation->set_rules('first_name', 'first_name', 'required');
        // $this->form_validation->set_rules('middle_initial', 'middle_initial', 'required');
        // $this->form_validation->set_rules('last_name', 'last_name', 'required');
  
        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $research_type = $this->input->post('research_type');
            $last_id = $this->author_publication_data();
            //data for presented
            $data2 = array(
                'title_presented' => $this->input->post('title'),
                'date_presentation' => $this->input->post('month_year'),
                'title_conference' => $this->input->post('title_conference'),
                'place_conference' => $this->input->post('place_conference'),
                'presented_type' => $research_type,
                'publication_id' => $last_id
            );
            $this->research_model->presented_insert($data2);
            redirect(base_url() . "research");
        }
    }

    public function presented_update(){
        //from presented
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('month_year', 'month_year', 'required');
        $this->form_validation->set_rules('title_conference', 'title_conference', 'required');
        $this->form_validation->set_rules('place_conference', 'place_conference', 'required');
        //from author
        // $this->form_validation->set_rules('first_name', 'first_name', 'required');
        // $this->form_validation->set_rules('middle_initial', 'middle_initial', 'required');
        // $this->form_validation->set_rules('last_name', 'last_name', 'required');
  
        if($this->form_validation->run() == FALSE){
            // $this->research_form();
        }else{
            $research_type = $this->input->post('research_type');
            $publication_id = $this->uri->segment(3);
            $this->author_publication_update($publication_id);
            //data for presented
            $data2 = array(
                'title_presented' => $this->input->post('title'),
                'date_presentation' => $this->input->post('month_year'),
                'title_conference' => $this->input->post('title_conference'),
                'place_conference' => $this->input->post('place_conference'),
                'presented_type' => $research_type,
                'publication_id' => $publication_id
            );
            $this->research_model->presented_update($data2, $publication_id);
            redirect(base_url() . "research");
        }
    }

    public function published_submit(){
        //from presented
        $this->form_validation->set_rules('year_published', 'year_published', 'required'); 
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('month_year', 'month_year', 'required');
        $this->form_validation->set_rules('title_conference', 'title_conference', 'required');
        $this->form_validation->set_rules('place_conference', 'place_conference', 'required');
        //from author
        // $this->form_validation->set_rules('first_name', 'first_name', 'required');
        // $this->form_validation->set_rules('middle_initial', 'middle_initial', 'required');
        // $this->form_validation->set_rules('last_name', 'last_name', 'required');
  
        if(!$this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $research_type = $this->input->post('research_type');
            $last_id = $this->author_publication_data();
            //data for presented
            $data2 = array(
                'title_presented' => $this->input->post('title'),
                'date_presentation' => $this->input->post('month_year'),
                'title_conference' => $this->input->post('title_conference'),
                'place_conference' => $this->input->post('place_conference'),
                'presented_type' => $research_type,
                'publication_id' => $last_id
            );
            $this->research_model->published_insert($data2);
            redirect(base_url() . "research");
        }
    }
    
}
?>