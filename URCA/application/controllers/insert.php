<?php
class Insert extends CI_Controller{
    #public function __construct(){
    #parent::__construct();
    #    $this->load->model('insertion_model');
    # }

    //for redirecting url
    public function index(){
        $this->load->view('latest/header');
		$this->load->view('latest/submit', $data);
        $this->load->view('latest/footer');
    }

    //insert function
    public function completed_form_validation(){
        //echo "good shite";
        $this->load->library('form_validation');
        //requirements for inputting data
        $this->form_validation->set_rules("thesisFirst", "Thesis First", 'required');
        $this->form_validation->set_rules("thesisMiddle", "Thesis Middle", 'required');
        $this->form_validation->set_rules("thesisLast", "Thesis Last", 'required');
        $this->form_validation->set_rules("thesisYear", "Thesis Year", 'required|numeric');
        $this->form_validation->set_rules("thesisTitle", "Thesis Title", 'required');
        $this->form_validation->set_rules("thesisURL", "Thesis URL", array());
        $this->form_validation->set_rules("thesisInstitute", "Thesis Institute", 'required');
        $this->form_validation->set_rules("thesisLocation", "Thesis Location", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('thesisFile')){
            echo "error";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    //assign input name to table column
                    'cr_first' =>$this->input->post("thesisFirst"),
                    'cr_middle' =>$this->input->post("thesisMiddle"),
                    'cr_last' =>$this->input->post("thesisLast"),
                    'cr_year' =>$this->input->post("thesisYear"),
                    'cr_title' =>$this->input->post("thesisTitle"),
                    'cr_url' =>$this->input->post("thesisURL"),
                    'cr_institute' =>$this->input->post("thesisInstitute"),
                    'cr_location' =>$this->input->post("thesisLocation"),
                    'cr_file' =>$pdf,
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                //calls function from insertion_model
                $this->insertion_model->insert_data($data);
                redirect(base_url() . "insert/thesis_table");
            }    
        }
        
        //if TRUE then function will run   
    }

    public function technical_form_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("technicalFirst", "Technical First", 'required');
        $this->form_validation->set_rules("technicalMiddle", "Technical Middle", 'required');
        $this->form_validation->set_rules("technicalLast", "Technical Last", 'required');
        $this->form_validation->set_rules("technicalYear", "Technical Year", 'required|numeric');
        $this->form_validation->set_rules("technicalTitle", "Technical Title", 'required');
        $this->form_validation->set_rules("technicalURL", "Technical URL", array());
        $this->form_validation->set_rules("technicalInstitute", "Technical Institute", 'required');
        $this->form_validation->set_rules("technicalLocation", "Technical Location", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('technicalFile')){
            echo "error";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];

            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'cr_first' =>$this->input->post("technicalFirst"),
                    'cr_middle' =>$this->input->post("technicalMiddle"),
                    'cr_last' =>$this->input->post("technicalLast"),
                    'cr_year' =>$this->input->post("technicalYear"),
                    'cr_title' =>$this->input->post("technicalTitle"),
                    'cr_institute' =>$this->input->post("technicalInstitute"),
                    'cr_location' =>$this->input->post("technicalLocation"),
                    'cr_file' =>$pdf,
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->insert_data($data);
                redirect(base_url() . "insert/thesis_table");
            }
            else{
                $this->index();
            }
        };
    }

    public function conpaper_form_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("conpaperFirst", "Conference Paper First", 'required');
        $this->form_validation->set_rules("conpaperMiddle", "Conference Paper Middle", 'required');
        $this->form_validation->set_rules("conpaperLast", "Conference Paper Last", 'required');
        $this->form_validation->set_rules("conpaperYear", "Conference Paper Year", 'required|numeric');
        $this->form_validation->set_rules("conpaperMonth", "Conference Paper Month", 'required|alpha');
        $this->form_validation->set_rules("conpaperTitle", "Conference Paper Title", 'required');
        $this->form_validation->set_rules("conpaperFull", "Conference Paper Full", 'required');
        $this->form_validation->set_rules("conpaperPlace", "Conference Paper Place", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf|jpg';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('conpaperFile')){
            echo "error";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];

            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'pd_first' =>$this->input->post("conpaperFirst"),
                    'pd_middle' =>$this->input->post("conpaperMiddle"),
                    'pd_last' =>$this->input->post("conpaperLast"),
                    'pd_year' =>$this->input->post("conpaperYear"),
                    'pd_month' =>$this->input->post("conpaperMonth"),
                    'pd_title' =>$this->input->post("conpaperTitle"),
                    'pd_conference_title' =>$this->input->post("conpaperFull"),
                    'pd_place' =>$this->input->post("conpaperPlace"),
                    'pd_file' =>$pdf,
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->insert_presented_data($data);
                redirect(base_url() . "insert/thesis_table");
            }
            else{
                $this->index();
            }
        };
    }

    public function conposter_form_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("conposterAuthor", "Conference Poster Author", 'required');
        $this->form_validation->set_rules("conposterYear", "Conference Poster Year", 'required|numeric');
        $this->form_validation->set_rules("conposterMonth", "Conference Poster Month", 'required|alpha');
        $this->form_validation->set_rules("conposterTitle", "Conference Poster Title", 'required');
        $this->form_validation->set_rules("conposterFull", "Conference Poster Full", 'required');
        $this->form_validation->set_rules("conposterPlace", "Conference Poster Place", 'required');

        if($this->form_validation->run()){
            $this->load->model("insertion_model");
            $data = array(
                'pd_author' =>$this->input->post("conposterAuthor"),
                'pd_year' =>$this->input->post("conposterYear"),
                'pd_month' =>$this->input->post("conposterMonth"),
                'pd_title' =>$this->input->post("conposterTitle"),
                'pd_conference_title' =>$this->input->post("conposterFull"),
                'pd_place' =>$this->input->post("conposterPlace"),
                'user_id' =>$this->session->userdata['logged_in']['id']
            );
            $this->insertion_model->insert_presented_data($data);
            redirect(base_url() . "insert/thesis_table");
        }
        else{
            $this->index();
        }
    }

    public function journalart_form_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("journalAuthor", "Journal Article Author", 'required');
        $this->form_validation->set_rules("journalYear", "Journal Article Year", 'required|numeric');
        $this->form_validation->set_rules("journalVolume", "Journal Article Volume", 'required|numeric');
        $this->form_validation->set_rules("journalArticle", "Journal Article Title", 'required');
        $this->form_validation->set_rules("journalJournal", "Journal Article Journal Title", 'required');
        $this->form_validation->set_rules("journalIndex", "Journal Article Index Database", 'required');
        $this->form_validation->set_rules("journalIssue", "Journal Article Issue Number", 'required|numeric');
        $this->form_validation->set_rules("journalPage", "Journal Article Page Number", 'required|numeric');
        $this->form_validation->set_rules("journalPeer", "Journal Article Peer review", 'required');

        if($this->form_validation->run()){
            $this->load->model("insertion_model");
            $data = array(
                'ja_author' =>$this->input->post("journalAuthor"),
                'ja_year_published' =>$this->input->post("journalYear"),
                'ja_article_title' =>$this->input->post("journalArticle"),
                'ja_journal_title' =>$this->input->post("journalJournal"),
                'ja_volume_number' =>$this->input->post("journalVolume"),
                'ja_issue_number' =>$this->input->post("journalIssue"),
                'ja_page_number' =>$this->input->post("journalPage"),
                'ja_indexing_database' =>$this->input->post("journalIndex"),
                'ja_peer_review' =>$this->input->post("journalPeer"),
                'user_id' =>$this->session->userdata['logged_in']['id']
            );
            $this->insertion_model->insert_journal_article_data($data);
            redirect(base_url() . "insert/thesis_table");
        }
        else{
            $this->index();
        }
    }

    public function book_textbook_form_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("btAuthor", "Book/Textbook Author", 'required');
        $this->form_validation->set_rules("btYear", "Book/Textbook Year", 'required|numeric');
        $this->form_validation->set_rules("btTitle", "Book/Textbook Title", 'required');
        $this->form_validation->set_rules("btPublisher", "Book/Textbook Publisher", 'required');
        $this->form_validation->set_rules("btPlace", "Book/Textbook Place of Publication", 'required');

        if($this->form_validation->run()){
            $this->load->model("insertion_model");
            $data = array(
                'bk_author' =>$this->input->post("btAuthor"),
                'bk_year_published' =>$this->input->post("btYear"),
                'bk_title' =>$this->input->post("btTitle"),
                'bk_publisher' =>$this->input->post("btPublisher"),
                'bk_place_of_publication' =>$this->input->post("btPlace"),
                'user_id' =>$this->session->userdata['logged_in']['id']
            );
            $this->insertion_model->insert_book_textbook_data($data);
            redirect(base_url() . "insert/thesis_table");
        }
        else{
            $this->index();
        }
    }

    public function book_chapter_form_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("bcYear", "Book Chapter Year", 'required|numeric');
        $this->form_validation->set_rules("bcAuthor", "Book Chapter Author", 'required');
        $this->form_validation->set_rules("bcTitleChap", "Book Chapter Title", 'required');
        $this->form_validation->set_rules("bcTitleBook", "Book Title", 'required');
        $this->form_validation->set_rules("bcEditor", "Book Chapter Editor", 'required');
        $this->form_validation->set_rules("bcPage", "Book Chapter Page Number", 'required|numeric');
        $this->form_validation->set_rules("bcPublisher", "Book Chapter Publisher", 'required');
        $this->form_validation->set_rules("bcPlace", "Book Chapter Place of Publication", 'required');

        if($this->form_validation->run()){
            $this->load->model("insertion_model");
            $data = array(
                'bc_year' =>$this->input->post("bcYear"),
                'bc_author' =>$this->input->post("bcAuthor"),
                'bc_title_chapter' =>$this->input->post("bcTitleChap"),
                'bc_title_book' =>$this->input->post("bcTitleBook"),
                'bc_editor' =>$this->input->post("bcEditor"),
                'bc_page_number' =>$this->input->post("bcPage"),
                'bc_publisher' =>$this->input->post("bcPublisher"),
                'bc_publication_place' =>$this->input->post("bcPlace"),
                'user_id' =>$this->session->userdata['logged_in']['id']
            );
            $this->insertion_model->insert_book_chapter_data($data);
            redirect(base_url() . "insert/thesis_table");
        }
        else{
            $this->index();
        }
    }

    public function conference_proceedings_form_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("cpAuthor", "Conference Proceeding Author", 'required');
        $this->form_validation->set_rules("cpYear", "Conference Proceeding Year Published", 'required|numeric');
        $this->form_validation->set_rules("cpArticle", "Conference Proceeding Article Title", 'required');
        $this->form_validation->set_rules("cpConference", "Conference Proceeding Conference Title", 'required');
        $this->form_validation->set_rules("cpEditor", "Conference Proceeding Editor", 'required');
        $this->form_validation->set_rules("cpPlaceCon", "Conference Proceeding Place of Conference", 'required');
        $this->form_validation->set_rules("cpPage", "Conference Proceeding Page", 'required|numeric');
        $this->form_validation->set_rules("cpPublisher", "Conference Proceeding Publisher", 'required');
        $this->form_validation->set_rules("cpPlacePub", "Conference Proceeding Place of Publication", 'required');
        $this->form_validation->set_rules("cpUrl", "Conference Proceeding URL", array());
       

        if($this->form_validation->run()){
            $this->load->model("insertion_model");
            $data = array(
                'cp_author' =>$this->input->post("cpAuthor"),
                'cp_year' =>$this->input->post("cpYear"),
                'cp_title_article' =>$this->input->post("cpArticle"),
                'cp_title_conference' =>$this->input->post("cpConference"),
                'cp_editor' =>$this->input->post("cpEditor"),
                'cp_conference_place' =>$this->input->post("cpPlaceCon"),
                'cp_page_number' =>$this->input->post("cpPage"),
                'cp_publisher' =>$this->input->post("cpPublisher"),
                'cp_publication_place' =>$this->input->post("cpPlacePub"),
                'cp_url' =>$this->input->post("cpUrl"),
                'user_id' =>$this->session->userdata['logged_in']['id']
            );
            $this->insertion_model->insert_conference_proceedings_data($data);
            redirect(base_url() . "insert/thesis_table");
        }
        else{
            $this->index();
        }
    }

    public function creative_work_form_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("cwCreator", "Creative Work Creator", 'required');
        $this->form_validation->set_rules("cwType", "Creative Work Type", 'required');
        $this->form_validation->set_rules("cwDate", "Creative Work Year", 'required');
        $this->form_validation->set_rules("cwTitle", "Creative Work Title", 'required');
        $this->form_validation->set_rules("cwRole", "Creative Work Role", 'required');
        $this->form_validation->set_rules("cwPlace", "Creative Work Place of Publication", 'required');
        $this->form_validation->set_rules("cwPublisher", "Creative Work Publisher", 'required');
        $this->form_validation->set_rules("cwDuration", "Creative Work Duration of Performance", 'required');
        $this->form_validation->set_rules("cwExhibited", "Creative Work Exhibited Works", 'required');
        $this->form_validation->set_rules("cwScope", "Creative Work Scope", 'required');
        $this->form_validation->set_rules("cwAgency", "Creative Work Agency", 'required');
        $this->form_validation->set_rules("cwAwards", "Creative Work Awards", 'required');

        if($this->form_validation->run()){
            $this->load->model("insertion_model");
            $data = array(
                'cw_creator' =>$this->input->post("cwCreator"),
                'cw_type' =>$this->input->post("cwType"),
                'cw_date' =>$this->input->post("cwDate"),
                'cw_title' =>$this->input->post("cwTitle"),
                'cw_role' =>$this->input->post("cwRole"),
                'cw_exhibition' =>$this->input->post("cwPlace"),
                'cw_producer' =>$this->input->post("cwPublisher"),
                'cw_duration' =>$this->input->post("cwDuration"),
                'cw_artworks_exibited' =>$this->input->post("cwExhibited"),
                'cw_audience_scope' =>$this->input->post("cwScope"),
                'cw_commissioning_agency' =>$this->input->post("cwAgency"),
                'cw_award_received' =>$this->input->post("cwAwards"),
                'user_id' =>$this->session->userdata['logged_in']['id']
            );
            $this->insertion_model->insert_creative_work_data($data);
            redirect(base_url() . "insert/thesis_table");
        }
        else{
            $this->index();
        }
    }

    public function update_researchCR(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('thesisFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    //assign input name to table column
                    
                    'cr_file' =>$pdf,
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                //calls function from insertion_model
                $this->insertion_model->update_researchCR($id,$data);
                redirect(base_url() . "research/research_table");
            } 
        }
        
        //if TRUE then function will run   
    }

    public function update_researchTH(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("technicalFirst", "Technical First", 'required');
        $this->form_validation->set_rules("technicalMiddle", "Technical Middle", 'required');
        $this->form_validation->set_rules("technicalLast", "Technical Last", 'required');
        $this->form_validation->set_rules("technicalYear", "Technical Year", 'required|numeric');
        $this->form_validation->set_rules("technicalTitle", "Technical Title", 'required');
        $this->form_validation->set_rules("technicalURL", "Technical URL", array());
        $this->form_validation->set_rules("technicalInstitute", "Technical Institute", 'required');
        $this->form_validation->set_rules("technicalLocation", "Technical Location", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('technicalFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           echo $cr_first= $this->input->post('technicalTitle');
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'cr_first' =>$this->input->post("technicalFirst"),
                    'cr_middle' =>$this->input->post("technicalMiddle"),
                    'cr_last' =>$this->input->post("technicalLast"),
                    'cr_year' =>$this->input->post("technicalYear"),
                    'cr_title' =>$this->input->post("technicalTitle"),
                    'cr_institute' =>$this->input->post("technicalInstitute"),
                    'cr_location' =>$this->input->post("technicalLocation"),
                    'cr_file' =>$pdf,
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                //calls function from insertion_model
                $this->insertion_model->update_researchCR($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        }
        
        //if TRUE then function will run   
    }

    public function update_researchCFP(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("conpaperFirst", "Conference Paper First", 'required');
        $this->form_validation->set_rules("conpaperMiddle", "Conference Paper Middle", 'required');
        $this->form_validation->set_rules("conpaperLast", "Conference Paper Last", 'required');
        $this->form_validation->set_rules("conpaperYear", "Conference Paper Year", 'required|numeric');
        $this->form_validation->set_rules("conpaperMonth", "Conference Paper Month", 'required|alpha');
        $this->form_validation->set_rules("conpaperTitle", "Conference Paper Title", 'required');
        $this->form_validation->set_rules("conpaperFull", "Conference Paper Full", 'required');
        $this->form_validation->set_rules("conpaperPlace", "Conference Paper Place", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('presentedFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           echo $cr_first= $this->input->post('conpaperTitle');
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'pd_first' =>$this->input->post("conpaperFirst"),
                    'pd_middle' =>$this->input->post("conpaperMiddle"),
                    'pd_last' =>$this->input->post("conpaperLast"),
                    'pd_year' =>$this->input->post("conpaperYear"),
                    'pd_month' =>$this->input->post("conpaperMonth"),
                    'pd_title' =>$this->input->post("conpaperTitle"),
                    'pd_conference_title' =>$this->input->post("conpaperFull"),
                    'pd_place' =>$this->input->post("conpaperPlace"),
                    'pd_file' =>$pdf,
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->update_researchPD($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        } 
    }

    public function update_researchCPP(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("conposterAuthor", "Conference Poster Author", 'required');
        $this->form_validation->set_rules("conposterYear", "Conference Poster Year", 'required|numeric');
        $this->form_validation->set_rules("conposterMonth", "Conference Poster Month", 'required|alpha');
        $this->form_validation->set_rules("conposterTitle", "Conference Poster Title", 'required');
        $this->form_validation->set_rules("conposterFull", "Conference Poster Full", 'required');
        $this->form_validation->set_rules("conposterPlace", "Conference Poster Place", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('conposterFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           echo $cr_first= $this->input->post('conposterTitle');
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'pd_author' =>$this->input->post("conposterAuthor"),
                    'pd_year' =>$this->input->post("conposterYear"),
                    'pd_month' =>$this->input->post("conposterMonth"),
                    'pd_title' =>$this->input->post("conposterTitle"),
                    'pd_conference_title' =>$this->input->post("conposterFull"),
                    'pd_place' =>$this->input->post("conposterPlace"),
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->update_researchPD($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        } 
    }

    public function update_researchJA(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("journalAuthor", "Journal Article Author", 'required');
        $this->form_validation->set_rules("journalYear", "Journal Article Year", 'required|numeric');
        $this->form_validation->set_rules("journalVolume", "Journal Article Volume", 'required|numeric');
        $this->form_validation->set_rules("journalArticle", "Journal Article Title", 'required');
        $this->form_validation->set_rules("journalJournal", "Journal Article Journal Title", 'required');
        $this->form_validation->set_rules("journalIndex", "Journal Article Index Database", 'required');
        $this->form_validation->set_rules("journalIssue", "Journal Article Issue Number", 'required|numeric');
        $this->form_validation->set_rules("journalPage", "Journal Article Page Number", 'required|numeric');
        $this->form_validation->set_rules("journalPeer", "Journal Article Peer review", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('journalFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           echo $cr_first= $this->input->post('journalArticle');
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'ja_author' =>$this->input->post("journalAuthor"),
                    'ja_year_published' =>$this->input->post("journalYear"),
                    'ja_article_title' =>$this->input->post("journalArticle"),
                    'ja_journal_title' =>$this->input->post("journalJournal"),
                    'ja_volume_number' =>$this->input->post("journalVolume"),
                    'ja_issue_number' =>$this->input->post("journalIssue"),
                    'ja_page_number' =>$this->input->post("journalPage"),
                    'ja_indexing_database' =>$this->input->post("journalIndex"),
                    'ja_peer_review' =>$this->input->post("journalPeer"),
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->update_researchJA($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        } 
    }

    public function update_researchBT(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("btAuthor", "Book/Textbook Author", 'required');
        $this->form_validation->set_rules("btYear", "Book/Textbook Year", 'required|numeric');
        $this->form_validation->set_rules("btTitle", "Book/Textbook Title", 'required');
        $this->form_validation->set_rules("btPublisher", "Book/Textbook Publisher", 'required');
        $this->form_validation->set_rules("btPlace", "Book/Textbook Place of Publication", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('booktextFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           echo $cr_first= $this->input->post('btTitle');
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'bk_author' =>$this->input->post("btAuthor"),
                    'bk_year_published' =>$this->input->post("btYear"),
                    'bk_title' =>$this->input->post("btTitle"),
                    'bk_publisher' =>$this->input->post("btPublisher"),
                    'bk_place_of_publication' =>$this->input->post("btPlace"),
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->update_researchBT($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        } 
    }

    public function update_researchBC(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("bcYear", "Book Chapter Year", 'required|numeric');
        $this->form_validation->set_rules("bcAuthor", "Book Chapter Author", 'required');
        $this->form_validation->set_rules("bcTitleChap", "Book Chapter Title", 'required');
        $this->form_validation->set_rules("bcTitleBook", "Book Title", 'required');
        $this->form_validation->set_rules("bcEditor", "Book Chapter Editor", 'required');
        $this->form_validation->set_rules("bcPage", "Book Chapter Page Number", 'required|numeric');
        $this->form_validation->set_rules("bcPublisher", "Book Chapter Publisher", 'required');
        $this->form_validation->set_rules("bcPlace", "Book Chapter Place of Publication", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('bookchapterFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           echo $cr_first= $this->input->post('bcTitle');
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'bc_year' =>$this->input->post("bcYear"),
                    'bc_author' =>$this->input->post("bcAuthor"),
                    'bc_title_chapter' =>$this->input->post("bcTitleChap"),
                    'bc_title_book' =>$this->input->post("bcTitleBook"),
                    'bc_editor' =>$this->input->post("bcEditor"),
                    'bc_page_number' =>$this->input->post("bcPage"),
                    'bc_publisher' =>$this->input->post("bcPublisher"),
                    'bc_publication_place' =>$this->input->post("bcPlace"),
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->update_researchBC($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        } 
    }

    public function update_researchBC(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("bcYear", "Book Chapter Year", 'required|numeric');
        $this->form_validation->set_rules("bcAuthor", "Book Chapter Author", 'required');
        $this->form_validation->set_rules("bcTitleChap", "Book Chapter Title", 'required');
        $this->form_validation->set_rules("bcTitleBook", "Book Title", 'required');
        $this->form_validation->set_rules("bcEditor", "Book Chapter Editor", 'required');
        $this->form_validation->set_rules("bcPage", "Book Chapter Page Number", 'required|numeric');
        $this->form_validation->set_rules("bcPublisher", "Book Chapter Publisher", 'required');
        $this->form_validation->set_rules("bcPlace", "Book Chapter Place of Publication", 'required');

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('bookchapterFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           echo $cr_first= $this->input->post('bcTitle');
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'bc_year' =>$this->input->post("bcYear"),
                    'bc_author' =>$this->input->post("bcAuthor"),
                    'bc_title_chapter' =>$this->input->post("bcTitleChap"),
                    'bc_title_book' =>$this->input->post("bcTitleBook"),
                    'bc_editor' =>$this->input->post("bcEditor"),
                    'bc_page_number' =>$this->input->post("bcPage"),
                    'bc_publisher' =>$this->input->post("bcPublisher"),
                    'bc_publication_place' =>$this->input->post("bcPlace"),
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->update_researchBC($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        } 
    }

    public function update_researchCP(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("cpAuthor", "Conference Proceeding Author", 'required');
        $this->form_validation->set_rules("cpYear", "Conference Proceeding Year Published", 'required|numeric');
        $this->form_validation->set_rules("cpArticle", "Conference Proceeding Article Title", 'required');
        $this->form_validation->set_rules("cpConference", "Conference Proceeding Conference Title", 'required');
        $this->form_validation->set_rules("cpEditor", "Conference Proceeding Editor", 'required');
        $this->form_validation->set_rules("cpPlaceCon", "Conference Proceeding Place of Conference", 'required');
        $this->form_validation->set_rules("cpPage", "Conference Proceeding Page", 'required|numeric');
        $this->form_validation->set_rules("cpPublisher", "Conference Proceeding Publisher", 'required');
        $this->form_validation->set_rules("cpPlacePub", "Conference Proceeding Place of Publication", 'required');
        $this->form_validation->set_rules("cpUrl", "Conference Proceeding URL", array());

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('conferenceproceedingsFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           echo $cr_first= $this->input->post('cpArticle');
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'cp_author' =>$this->input->post("cpAuthor"),
                    'cp_year' =>$this->input->post("cpYear"),
                    'cp_title_article' =>$this->input->post("cpArticle"),
                    'cp_title_conference' =>$this->input->post("cpConference"),
                    'cp_editor' =>$this->input->post("cpEditor"),
                    'cp_conference_place' =>$this->input->post("cpPlaceCon"),
                    'cp_page_number' =>$this->input->post("cpPage"),
                    'cp_publisher' =>$this->input->post("cpPublisher"),
                    'cp_publication_place' =>$this->input->post("cpPlacePub"),
                    'cp_url' =>$this->input->post("cpUrl"),
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->update_researchCP($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        } 
    }

    public function update_researchCW(){
        $id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules("cpAuthor", "Conference Proceeding Author", 'required');
        $this->form_validation->set_rules("cpYear", "Conference Proceeding Year Published", 'required|numeric');
        $this->form_validation->set_rules("cpArticle", "Conference Proceeding Article Title", 'required');
        $this->form_validation->set_rules("cpConference", "Conference Proceeding Conference Title", 'required');
        $this->form_validation->set_rules("cpEditor", "Conference Proceeding Editor", 'required');
        $this->form_validation->set_rules("cpPlaceCon", "Conference Proceeding Place of Conference", 'required');
        $this->form_validation->set_rules("cpPage", "Conference Proceeding Page", 'required|numeric');
        $this->form_validation->set_rules("cpPublisher", "Conference Proceeding Publisher", 'required');
        $this->form_validation->set_rules("cpPlacePub", "Conference Proceeding Place of Publication", 'required');
        $this->form_validation->set_rules("cpUrl", "Conference Proceeding URL", array());

        $config['upload_path'] =  './pdf/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('conferenceproceedingsFile')){
            echo "no pdf found";
        }else{
            $upload = $this->upload->data();
            $pdf = $upload['file_name'];
            
           
            $this->load->view('latest/test');
            if($this->form_validation->run()){
                $this->load->model("insertion_model");
                $data = array(
                    'cp_author' =>$this->input->post("cpAuthor"),
                    'cp_year' =>$this->input->post("cpYear"),
                    'cp_title_article' =>$this->input->post("cpArticle"),
                    'cp_title_conference' =>$this->input->post("cpConference"),
                    'cp_editor' =>$this->input->post("cpEditor"),
                    'cp_conference_place' =>$this->input->post("cpPlaceCon"),
                    'cp_page_number' =>$this->input->post("cpPage"),
                    'cp_publisher' =>$this->input->post("cpPublisher"),
                    'cp_publication_place' =>$this->input->post("cpPlacePub"),
                    'cp_url' =>$this->input->post("cpUrl"),
                    'user_id' =>$this->session->userdata['logged_in']['id']
                );
                $this->insertion_model->update_researchCP($id,$data);
                redirect(base_url() . "insert/thesis_table");
            } 
        } 
    }

    //redirects to this location after data has been inserted
    public function thesis_table(){
        $this->load->model("insertion_model");
        $user_id = $this->session->userdata['logged_in']['id'];
        $data["fetch_comp_data"] = $this->insertion_model->fetch_comp_data($user_id);
        $data["fetch_presented_data"] = $this->insertion_model->fetch_presented_data($user_id);      
        $this->load->view('latest/header');
		$this->load->view('latest/table', $data);
        $this->load->view('latest/footer');
    }

    public function publication_table(){
        $this->load->model("insertion_model");
        $data["fetch_comp_data_all"] = $this->insertion_model->fetch_comp_data_all();
        $data["fetch_presented_data_all"] = $this->insertion_model->fetch_presented_data_all();
        $this->load->view('latest/header');
        $this->load->view('latest/Publication', $data);
        $this->load->view('latest/footer');
    }

    public function delete_data(){
        $id = $this->uri->segment(4);
        $this->load->model("insertion_model");
        $this->research_model->delete_data($id);
        redirect(base_url() . "insert/thesis_table");
    }

    public function delete_presented_data(){
        $id = $this->uri->segment(3);
        $this->load->model("insertion_model");
        $this->insertion_model->delete_presented_data($id);
        redirect(base_url() . "insert/thesis_table");
    }

    public function research_detail(){
        $id = $this->uri->segment(2);
        //$id = $this->input->get('cr_id');
        $this->load->model("insertion_model");
        $result['research_data'] = $this->insertion_model->get_research_detail($id);
        $this->load->view('latest/header');
        $this->load->view("latest/edit", $result);
        $this->load->view('latest/footer');
    }

    public function export_excel(){
        $this->load->model("insertion_model");
        $this->insertion_model->fetch();
        if(isset($_POST["export"]))
        {
        $output .= '
            <table class="table" bordered="1">  
                <tr>  
                    <th>Citation</th>
                    <th>View</th>
                    
                </tr>
            ';
           
            $output .= '
                <tr>  
                    <td>'.$row["cr_id"].'</td>
                    <td>'.$row["cr_author"].'</td>  
                    
                </tr>
            </table>
            ';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=download.xls');
            echo $output;
        }
}

function action(){
        $this->load->model("insertion_model");
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("ID", "Author", "Year", "Title", "Institute", "Location", "Url");

        $column = 0;

        foreach($table_columns as $field){
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $completed_research_data = $this->insertion_model->fetch_data();

        $excel_row = 2;

        foreach($completed_research_data as $row){
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->cr_id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->cr_author);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->cr_year);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->cr_title);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->cr_institute);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->cr_location);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->cr_url);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Search_Data.xls"');
        $object_writer->save('php://output');
    }

}?>