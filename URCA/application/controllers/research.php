<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Research extends CI_Controller{
    
    public function __construct(){
    parent::__construct();
        $this->load->model('research_model');
        $this->load->library('form_validation');
        $this->load->library('user_agent');
    }

    //get research id of the user who is logged in, (the one who will submit research)
    public function get_current_user(){
        $username = $this->session->userdata['logged_in']['username'];
        return $user_id = $this->research_model->current_user($username);
    }

    public function get_publication_type($publication_id){
        return $publication_type = $this->research_model->select_publication_type($publication_id);
    }

    public function research_form(){
        $username = $this->session->userdata['logged_in']['username'];
        $data['user_data'] = $this->research_model->select_user($username);
        $this->load->view('template/header');
		$this->load->view('research/research_form', $data);
        $this->load->view('template/footer');
    }

    public function publication(){
        $this->load->model('admin_model');
        $data["ex"] = $this->admin_model->fetch_data();
        $data["completed"] = $this->admin_model->fetch_pdf_completed();
        $data["presented"] = $this->admin_model->fetch_pdf_presented();
        $data["published"] = $this->admin_model->fetch_pdf_published();
        $data["creative"] = $this->admin_model->fetch_pdf_creative();
        $data["authors"] = $this->admin_model->fetch_all_authors_admin();
        $data["editors"] = $this->admin_model->fetch_all_editors_admin();
        $this->load->view('template/header');
        $this->load->view('research/pub', $data);
        $this->load->view('template/footer');
    }

    /*
    public function search2(){
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
    */

    // public function most_likes() {
    //     $data['most_liked'] = $this->research_model->get_most_likes();
    // }

    public function comment_report() {
        $publication_id = $this->uri->segment(3);
        date_default_timezone_set('Asia/Karachi');
        $now = date('Y-m-d H:i:s');
        $data = array(
            'user_id' => $this->get_current_user(),
            'publication_id' => $publication_id,
            'type' => 'Report',
            'time' => $now,
            'status' => 'Unread'
        );
        $this->research_model->report_comment($data);
        redirect(base_url() . "research/view/".$publication_id);
    }

    public function comment_delete() {
        $comment_id = $this->uri->segment(3);
        $publication_id = $this->uri->segment(4);

        $this->research_model->delete_comment($comment_id);
        redirect(base_url() . "research/view/".$publication_id);
    }

    public function like_view() {
        $user_id = $this->get_current_user();
        $data["author_data"] = $this->research_model->fetch_all_authors();
        $data['liked_completed'] = $this->research_model->get_like_completed($user_id);
        $data['liked_presented'] = $this->research_model->get_like_presented($user_id);
        $data['liked_published'] = $this->research_model->get_like_published($user_id);
        $data['liked_creative'] = $this->research_model->get_like_creative($user_id);
        

        $this->load->view('template/header');
		$this->load->view('research/like', $data);
        $this->load->view('template/footer');
    }

    public function like_check(){
        $publication_id = $this->uri->segment(3);
        $user_id = $this->get_current_user();

        $data_check = array(
            'user_id' => $user_id,
            'publication_id' => $publication_id
        );
        $result = $this->research_model->like_check($data_check);
            if($result == TRUE) {
                //user already liked the research
                return TRUE;
            }else{
                //not yet liked
                return FALSE;
            }
    }

    public function like(){
        $publication_id = $this->uri->segment(3);
        $user_id = $this->get_current_user();

        $data = array(
            'user_id' => $user_id,
            'publication_id' => $publication_id
        );
        $this->research_model->like($data);
        redirect(base_url() . "research/view/".$publication_id);
    }

    public function unsubmit(){
        $publication_id = $this->uri->segment(3);
        $data = array(
            'status' => 'Unreviewed',
        );
        $this->research_model->publication_review($data, $publication_id);
        redirect(base_url() . "research/edit/".$publication_id);

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
        // if($keyword == NULL){
        //     redirect('search/'.$this->input>post('keyword'));
        // }
        $this->load->view('template/header');
		$this->load->view('research/search', $data);
        $this->load->view('template/footer');
    }
    

    public function notification(){
        if (isset($this->session->userdata['logged_in'])) {
            $user_type = ($this->session->userdata['logged_in']['user_type']);
        }
        $submittor = $this->get_current_user();
        if(isset($_POST["view"])){
            if($_POST["view"] != ''){
                if($user_type == 'Researcher'){
                    $update_notif = $this->research_model->update_notif();
                }else{
                    $update_notif = $this->research_model->update_notif_admin();
                }
            }
        $output = '';
        $data = $this->research_model->select_notif($submittor);
        
        $admin_data = $this->research_model->select_notif_admin();
        foreach($admin_data->result() as $row){
            if($user_type == "Admin"){
                $output .= 
                '<div class="small text-black-500">'.$row->time.'</div>
                <a href="'.base_url('research/view/'.$row->publication_id).'"
                <Strong>Comment Reported</Strong></a>';
            }
        }

        foreach($data->result() as $row){
            if($row->type == "Review"){
                $output .= 
                    '<div class="small text-black-500">'.$row->time.'</div>
                    <a href="'.base_url('research/edit/'.$row->publication_id).'"
                    <Strong>Your Research has been Reviewed</Strong></a>';
            }else {
                    $output .= 
                    '<div class="small text-black-500">'.$row->time.'</div>
                    <a href="'.base_url('research/view/'.$row->publication_id).'"
                    <Strong></Strong><b>'.$row->first_name.' '.$row->last_name.'</b> Commented on your Research</Strong></a>';    
            } }
        }
        if($user_type == "Admin"){
            $datacount = $this->research_model->count_notif_admin();
        }else if($user_type == "Researcher"){
            $datacount = $this->research_model->count_notif($submittor);
        }

        $count = $datacount->num_rows();
        $data2 = array(
            'load_notif' => $output,
            'unseen_notif' => $count
        );
        echo json_encode($data2);

    }


    public function research_table(){
        $user_id = $this->get_current_user();
        $data["completed_research"] = $this->research_model->select_all_completed($user_id);
        $data["presented_research"] = $this->research_model->select_all_presented($user_id);
        $data["published_research"] = $this->research_model->select_all_published($user_id);
        $data["creative_research"] = $this->research_model->select_all_creative($user_id);
        $data["authors"] = $this->research_model->fetch_all_authors();
        $data["editors"] = $this->research_model->fetch_all_editors();
        //$data["creative_research"] = $this->research_model->display_authors($user_id);
        //$data["creative_research"] = $this->research_model->select_all_creative($user_id);
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
        $data['like_data'] = $this->research_model->like_count($publication_id);
        $data['publication_type'] = $this->get_publication_type($publication_id); 
        $data["author_data"] = $this->research_model->fetch_all_authors();
        $data['like_or_not'] = $this->like_check();
        
        if($data['publication_type'] == 'Completed Research'){
            $data['research_data'] = $this->research_model->select_all_completed_view($publication_id); 
        }elseif($data['publication_type'] == 'Presented Research'){
            $data['research_data'] = $this->research_model->select_all_presented_view($publication_id);
        }elseif($data['publication_type'] == 'Published Research'){
            $data['research_data'] = $this->research_model->select_all_published_view($publication_id);
        }else{
            $data['research_data'] = $this->research_model->select_all_creative_view($publication_id);
        }
        $this->load->view("template/header");
        $this->load->view("research/view", $data);
        // $this->load->view("template/footer");

        $data['comment_data'] = $this->research_model->comment_display($publication_id);
        $this->load->view("research/comment", $data);
        $this->load->view("template/footer");
    }

    public function comment(){
        $publication_id = $this->uri->segment(3);
        date_default_timezone_set('Asia/Karachi');
        $now = date('Y-m-d H:i:s');
        $this->form_validation->set_rules('comment', 'comment', 'required');
        
        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{

            $data = array(
                'publication_id' => $publication_id,
                'user_id' => $this->session->userdata['logged_in']['user_id'],
                'message' => $this->input->post('comment'),
                'time_created' => $now
            );
            $this->research_model->comment_insert($data);
            //Insert to notif
            $data2 = array(
                'user_id' => $this->session->userdata['logged_in']['user_id'],
                'publication_id' => $publication_id,
                'type' => 'Comment',
                'time' => $now,
                'status' => 'Unread'
            );
            $this->research_model->send_notif($data2);
        }
        redirect('research/view/'.$publication_id);
    }

    public function edit(){
        $publication_id = $this->uri->segment(3); 
        $data['publication_type'] = $this->get_publication_type($publication_id); 
        $data["author_data"] = $this->research_model->fetch_all_authors();
        $data["editor_data"] = $this->research_model->fetch_all_editors();

        if($data['publication_type'] == 'Completed Research'){
            $data['research_data'] = $this->research_model->select_all_completed_view($publication_id); 
        }else if($data['publication_type'] == 'Presented Research'){
            $data['research_data'] = $this->research_model->select_all_presented_view($publication_id);
        }else if($data['publication_type'] == 'Published Research'){
            $data['research_data'] = $this->research_model->select_all_published_view($publication_id);
        }else{
            $data['research_data'] = $this->research_model->select_all_creative_view($publication_id);
        }

        $this->load->view("template/header");
        $this->load->view("research/edit", $data);
        $this->load->view("template/footer");    
    }

    public function upload_file(){
        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|jpg|png|txt|zip|rar';
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

    public function upload_file_update($publication_id){
        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|jpg|png|txt|zip|rar';
        $config['max_size'] = 0;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file')){
            //redirect(base_url() . "research/add");
            //add error when pdf is not uploaded
            $getfiles = $this->research_model->fetch_all_publication();
            foreach($getfiles as $key){
                if($key->publication_id == $publication_id){
                    $file = $key->file;
                }
            }
            return $file;
        }else{
            //$oldfile = $newfile ($upload['file_name'];
            $upload = $this->upload->data();
            $file = $upload['file_name'];
            return $file;
        }
    }

    public function author_publication_data($research_type){
        if($research_type == 'Thesis / Dissertation' || $research_type == 'Technical / Research Report'){
            $publication_type = 'Completed Research';
        }elseif($research_type == 'Conference Paper' || $research_type == 'Conference Poster'){
            $publication_type = 'Presented Research';
        }elseif($research_type == 'Journal Article' || $research_type == 'Book / Textbook' || $research_type == 'Book Chapter' || $research_type == 'Conference Proceedings'){
            $publication_type = 'Published Research';
        }else{
            $publication_type = 'Creative Works';
        }

        $file = $this->upload_file();

        //if($research_type == 'Thesis/ Dissertation)
        //$data = arry(
            // 'file' => $file,
            // 'abstract' => $this->input->post('abstract'),
            // 'num_views' => '0',
            // 'status' => 'Unreviewed',
            // 'publication_type' => $publication_type
        //);

        if (isset($this->session->userdata['logged_in'])) {
            $user_type = ($this->session->userdata['logged_in']['user_type']);
        }
        if($user_type == 'Admin'){
            $status = 'Approved';
        }else{
            $status = 'Unreviewed';
        }
        //data for publication
        date_default_timezone_set('Asia/Karachi');
        $now = date('M d Y');
        $data = array(
            'file' => $file,
            'date_submission' => $now,
            'submittor' => $this->get_current_user(),
            'abstract' => $this->input->post('abstract'),
            'num_views' => '0',
            'status' => $status,
            'publication_type' => $publication_type
        );
        $this->research_model->publication_insert($data);
        $last_id = $this->db->insert_id();

        //insert to author table
        $first_name = $this->input->post('first_name');
        $middle_initial = $this->input->post('middle_initial');
        $last_name = $this->input->post('last_name');

        for($i = 0; $i < count($first_name); $i++){
            if($i == 0){
                $data1 = array(
                    'publication_id' => $last_id,
                    'user_id' => $this->get_current_user(),
                    'first_name' => $first_name[$i],
                    'middle_initial' => $middle_initial[$i],
                    'last_name' => $last_name[$i],
                    'is_employee' => '1',
                    'author_type' => 'Main'
                );
            }else{
                $data1 = array(
                    'publication_id' => $last_id,
                    'user_id' => $this->get_current_user(),
                    'first_name' => $first_name[$i],
                    'middle_initial' => $middle_initial[$i],
                    'last_name' => $last_name[$i],
                    'is_employee' => '1',
                    'author_type' => 'Extra'
                );
            }
            $this->research_model->author_insert($data1);
        }
        return $last_id;
    }

    public function author_publication_update($publication_id){
        //data for author
        $first_name = $this->input->post('first_name');
        $middle_initial = $this->input->post('middle_initial');
        $last_name = $this->input->post('last_name');
        $author_id = $this->input->post('author_id');

            for($i = 0; $i < count($author_id); $i++){
                if($i == 0){
                    $data1[] = array(
                        'author_id' => $author_id[$i],
                        'user_id' => $this->get_current_user(),
                        'first_name' => $first_name[$i],
                        'middle_initial' => $middle_initial[$i],
                        'last_name' => $last_name[$i],
                        'is_employee' => '1',
                        'author_type' => 'Main'
                    );
                }else{
                    $data1[] = array(
                        'author_id' => $author_id[$i],
                        'user_id' => $this->get_current_user(),
                        'first_name' => $first_name[$i],
                        'middle_initial' => $middle_initial[$i],
                        'last_name' => $last_name[$i],
                        'is_employee' => '1',
                        'author_type' => 'Extra'
                    );
                }
            }
            $this->db->update_batch('author', $data1, 'author_id');

        $file = $this->upload_file_update($publication_id);
        //data for publication
        date_default_timezone_set('Asia/Karachi');
        $now = date('M d Y');
        $data = array(
            'file' => $file,
            'date_submission' => $now,
            'abstract' => $this->input->post('abstract'),
            'num_views' => '0',
            'status' => 'Unreviewed'
        );
        $this->research_model->publication_update($data, $publication_id);
        
    }

    public function editor_submit($pub_id){
        $editor_fn = $this->input->post('editor_fn');
        $editor_mi = $this->input->post('editor_mi');
        $editor_ln = $this->input->post('editor_ln');
        for($i = 0; $i < count($editor_fn); $i++){
            $data = array(
                'published_id' => $pub_id,
                'editor_fn' => $editor_fn[$i],
                'editor_mi' => $editor_mi[$i],
                'editor_ln' => $editor_ln[$i]
            );
        $this->research_model->editor_insert($data);
        }
    }

    public function editor_update(){
        $editor_fn = $this->input->post('editor_fn');
        $editor_mi = $this->input->post('editor_mi');
        $editor_ln = $this->input->post('editor_ln');
        $editor_id = $this->input->post('editor_id');
        $published_id = $this->input->post('published_id');
        for($i = 0; $i < count($editor_id); $i++){
            $data3[] = array(
                'editor_id' => $editor_id[$i],
                'published_id' => $published_id[$i],
                'editor_fn' => $editor_fn[$i],
                'editor_mi' => $editor_mi[$i],
                'editor_ln' => $editor_ln[$i]
            );
        }
        $this->db->update_batch('editor', $data3, 'editor_id');
    }
    

    public function completed_submit(){
        //from completed
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
        $this->form_validation->set_rules('institution', 'institution', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        
        $research_type = $this->input->post('research_type');
        if($research_type == 'Thesis / Dissertation'){
            $this->form_validation->set_rules('url', 'url');
        }

        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $last_id = $this->author_publication_data($research_type);
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
        $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
        $this->form_validation->set_rules('institution', 'institution', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        
        $research_type = $this->input->post('research_type');
        if($research_type == 'Thesis / Dissertation'){
            $this->form_validation->set_rules('url', 'url');
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
        
        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $research_type = $this->input->post('research_type');
            $last_id = $this->author_publication_data($research_type);
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
  
        if($this->form_validation->run() == FALSE){
            $this->research_form();
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
        $research_type = $this->input->post('research_type');
        if($research_type == 'Journal Article'){
            $this->form_validation->set_rules('title_article', 'title_article', 'required');
            $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
            $this->form_validation->set_rules('title_journal', 'title_journal');
            $this->form_validation->set_rules('vol_num', 'vol_num', 'required');
            $this->form_validation->set_rules('issue_num', 'issue_num');
            $this->form_validation->set_rules('page_num', 'page_num', 'required');
            $this->form_validation->set_rules('type', 'type', 'required');
            $this->form_validation->set_rules('peer', 'peer', 'required');
        }elseif($research_type == 'Book / Textbook'){
            $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
            $this->form_validation->set_rules('title_book', 'title_book', 'required');
            $this->form_validation->set_rules('publisher', 'publisher', 'required');
            $this->form_validation->set_rules('place', 'place', 'required');
        }elseif($research_type == 'Book Chapter'){
            $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
            $this->form_validation->set_rules('title_chapter', 'title_chapter', 'required');
            $this->form_validation->set_rules('title_book', 'title_book', 'required');
            $this->form_validation->set_rules('page_num', 'page_num', 'required');
            $this->form_validation->set_rules('publisher', 'publisher', 'required');
            $this->form_validation->set_rules('place', 'place', 'required');
        }else{
            $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
            $this->form_validation->set_rules('title_article', 'title_article', 'required');
            $this->form_validation->set_rules('title_conference', 'title_conference', 'required');
            $this->form_validation->set_rules('place_con', 'place_con', 'required');
            $this->form_validation->set_rules('page_num', 'page_num', 'required');
            $this->form_validation->set_rules('publisher', 'publisher', 'required');
            $this->form_validation->set_rules('place', 'place', 'required');
            $this->form_validation->set_rules('url', 'url');
        }

        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $last_id = $this->author_publication_data($research_type);
            //data for completed
            $data2 = array(
                'title_article' => $this->input->post('title_article'),
                'year_published' => $this->input->post('year'),
                'title_journal' => $this->input->post('title_journal'),
                'vol_num' => $this->input->post('vol_num'),
                'issue_num' => $this->input->post('issue_num'),
                'page_num' => $this->input->post('page_num'),
                'indexing_database' => $this->input->post('type'),
                'peer_review' => $this->input->post('peer'),
                'title_book' => $this->input->post('title_book'),
                'publisher' => $this->input->post('publisher'),
                'place_of_publication' => $this->input->post('place'),
                'title_chapter' => $this->input->post('title_chapter'),
                'title_book' => $this->input->post('title_book'),
                'title_conference' => $this->input->post('title_conference'),
                'place_of_conference' => $this->input->post('place_con'),
                'url' => $this->input->post('url'),
                'published_type' => $research_type,
                'publication_id' => $last_id
            );
            //if upate
            $this->research_model->published_insert($data2);
            $pub_id = $this->db->insert_id();
            if($research_type == 'Book Chapter' || $research_type == 'Conference Proceedings'){
                $this->editor_submit($pub_id);
            }
            redirect(base_url() . "research");
        } 
    }

    public function published_update(){
        $research_type = $this->input->post('research_type');
        if($research_type == 'Journal Article'){
            $this->form_validation->set_rules('title_article', 'title_article', 'required');
            $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
            $this->form_validation->set_rules('title_journal', 'title_journal');
            $this->form_validation->set_rules('vol_num', 'vol_num', 'required');
            $this->form_validation->set_rules('issue_num', 'issue_num');
            $this->form_validation->set_rules('page_num', 'page_num', 'required');
            $this->form_validation->set_rules('type', 'type', 'required');
            $this->form_validation->set_rules('peer', 'peer', 'required');
        }elseif($research_type == 'Book / Textbook'){
            $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
            $this->form_validation->set_rules('title_book', 'title_book', 'required');
            $this->form_validation->set_rules('publisher', 'publisher', 'required');
            $this->form_validation->set_rules('place', 'place', 'required');
        }elseif($research_type == 'Book Chapter'){
            $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
            $this->form_validation->set_rules('title_chapter', 'title_chapter', 'required');
            $this->form_validation->set_rules('title_book', 'title_book', 'required');
            $this->form_validation->set_rules('page_num', 'page_num', 'required');
            $this->form_validation->set_rules('publisher', 'publisher', 'required');
            $this->form_validation->set_rules('place', 'place', 'required');
        }else{
            $this->form_validation->set_rules('year', 'year', 'required|exact_length[4]');
            $this->form_validation->set_rules('title_article', 'title_article', 'required');
            $this->form_validation->set_rules('title_conference', 'title_conference', 'required');
            $this->form_validation->set_rules('place_con', 'place_con', 'required');
            $this->form_validation->set_rules('page_num', 'page_num', 'required');
            $this->form_validation->set_rules('publisher', 'publisher', 'required');
            $this->form_validation->set_rules('place', 'place', 'required');
            $this->form_validation->set_rules('url', 'url');
        }

        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $publication_id = $this->uri->segment(3);
            if($research_type == 'Book Chapter' || $research_type == 'Conference Proceedings'){
                $this->editor_update();
            }
            $this->author_publication_update($publication_id);

            $data2 = array(
                'title_article' => $this->input->post('title_article'),
                'year_published' => $this->input->post('year'),
                'title_journal' => $this->input->post('title_journal'),
                'vol_num' => $this->input->post('vol_num'),
                'issue_num' => $this->input->post('issue_num'),
                'page_num' => $this->input->post('page_num'),
                'indexing_database' => $this->input->post('type'),
                'peer_review' => $this->input->post('peer'),
                'title_book' => $this->input->post('title_book'),
                'publisher' => $this->input->post('publisher'),
                'place_of_publication' => $this->input->post('place'),
                'title_chapter' => $this->input->post('title_chapter'),
                'title_book' => $this->input->post('title_book'),
                'title_conference' => $this->input->post('title_conference'),
                'place_of_conference' => $this->input->post('place_con'),
                'url' => $this->input->post('url'),
                'published_type' => $research_type,
                'publication_id' => $publication_id
            );

            $this->research_model->published_update($data2, $publication_id);
            redirect(base_url() . "research");
        }
    }

    public function creative_submit(){
        //from presented
        $this->form_validation->set_rules('type', 'Type of Research/Creative Work', 'required');
        $this->form_validation->set_rules('month_year', 'Month & Year', 'required');
        $this->form_validation->set_rules('title', 'Title of Work', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('place', 'Place of Performance / Publication / Exhibition', 'required');  
        $this->form_validation->set_rules('publisher', 'Producer / Organizer / Publisher');
        $this->form_validation->set_rules('duration', 'Duration of performance / exhibition');
        $this->form_validation->set_rules('exhibited', 'Number of artworks exhibited');
        $this->form_validation->set_rules('scope', 'Scope of audience', 'required');
        $this->form_validation->set_rules('comm', 'Commissioning Agency');
        $this->form_validation->set_rules('award', 'Award Received');

        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            $research_type = $this->input->post('research_type');
            $last_id = $this->author_publication_data($research_type);
            //data for presented
            $data2 = array(
                'type_cw' => $this->input->post('type'),
                'month_year' => $this->input->post('month_year'),
                'title_work' => $this->input->post('title'),
                'role' => $this->input->post('role'),
                'place_performance' => $this->input->post('place'),
                'publisher' => $this->input->post('publisher'),
                'artwork_exhibited' => $this->input->post('exhibited'),
                'duration_performance' => $this->input->post('duration'),
                'commission_agency' => $this->input->post('comm'),
                'scope_audience' => $this->input->post('scope'),
                'award_received' => $this->input->post('award'),
                'publication_id' => $last_id
            );
            $this->research_model->creative_insert($data2);
            redirect(base_url() . "research");
        }
    }

    public function creative_update(){
        $this->form_validation->set_rules('type', 'Type of Research/Creative Work', 'required');
        $this->form_validation->set_rules('month_year', 'Month & Year', 'required');
        $this->form_validation->set_rules('title', 'Title of Work', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('place', 'Place of Performance / Publication / Exhibition', 'required');  
        $this->form_validation->set_rules('publisher', 'Producer / Organizer / Publisher');
        $this->form_validation->set_rules('duration', 'Duration of performance / exhibition');
        $this->form_validation->set_rules('exhibited', 'Number of artworks exhibited');
        $this->form_validation->set_rules('scope', 'Scope of audience', 'required');
        $this->form_validation->set_rules('comm', 'Commissioning Agency');
        $this->form_validation->set_rules('award', 'Award Received');
        //from author
  
        if($this->form_validation->run() == FALSE){
            $this->research_form();
        }else{
            //$research_type = $this->input->post('research_type');
            $publication_id = $this->uri->segment(3);
            $this->author_publication_update($publication_id);
            //data
            $data2 = array(
                'type_cw' => $this->input->post('type'),
                'month_year' => $this->input->post('month_year'),
                'title_work' => $this->input->post('title'),
                'role' => $this->input->post('role'),
                'place_performance' => $this->input->post('place'),
                'publisher' => $this->input->post('publisher'),
                'artwork_exhibited' => $this->input->post('exhibited'),
                'duration_performance' => $this->input->post('duration'),
                'commission_agency' => $this->input->post('comm'),
                'scope_audience' => $this->input->post('scope'),
                'award_received' => $this->input->post('award'),
                'publication_id' => $publication_id
            );
            $this->research_model->creative_update($data2, $publication_id);
            redirect(base_url() . "research");
        }
    }
    
}
?>