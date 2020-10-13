<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller{
 
    public function __construct() {
    parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        $this->load->library('Pdf.php');
        $this->load->helper('download');
    }
    
    public function index(){
        $data['total_pub'] = $this->research_model->total_pub_count();
        $data['unreviewed_count'] = $this->research_model->unreviewed_count();
        $data['reviewed_count'] = $this->research_model->reviewed_count();
        $data['rejected_count'] = $this->research_model->rejected_count();

        $this->load->view('template/header');
		$this->load->view('urc/dashboard', $data);
        $this->load->view('template/footer');
    }


    public function get_current_user(){
        $username = $this->session->userdata['logged_in']['username'];
        return $user_id = $this->admin_model->current_user($username);
    }

    public function unreviewed_submissions(){
        $data["publication_unreviewed"] = $this->admin_model->publication_select_unreviewed();
        $this->load->view('template/header');
		$this->load->view('urc/unreviewed', $data);
        $this->load->view('template/footer');
    }

    public function approved_submissions(){
        $data["publication_approved"] = $this->admin_model->publication_select_approved();
        $this->load->view('template/header');
		$this->load->view('urc/approved', $data);
        $this->load->view('template/footer');
    }

    public function rejected_submissions(){
        $data["publication_rejected"] = $this->admin_model->publication_select_rejected();
        $this->load->view('template/header');
		$this->load->view('urc/rejected', $data);
        $this->load->view('template/footer');
    }

    public function review(){
        $publication_id = $this->uri->segment(3); //display approve_submissions url
        // $this->form_validation->set_rules('feedback', 'feedback', 'required');
        if($this->input->post('feedback') == ''){
            //approve
            $data = array(
                'status' => 'Approved'
            );
           $this->admin_model->publication_review($data, $publication_id);
        }else{
            //reject
            $data = array(
                'status' => 'Rejected',
                'feedback' => $this->input->post('feedback')
            );
            $this->admin_model->publication_review($data, $publication_id);
        }
        $publication_id = $this->uri->segment(3); 
        date_default_timezone_set('Asia/Karachi');
        $now = date('Y-m-d H:i:s');
        $data2 = array(
            'user_id' => $this->get_current_user(),
            'publication_id' => $publication_id,
            'type' => 'Review',
            'time' => $now,
            'status' => 'Unread'
        );
        $this->admin_model->send_notif($data2);
        // //data for logs
        // date_default_timezone_set('Asia/Karachi');
        // $now = date('Y-m-d H:i:s');
        // $data = array(
        //     'admin_id' => $this->get_admin_id(),
        //     'feedback' => $this->input->post('feedback'),
        //     'time' => $now,
        //     'publication_id' => $publication_id
        // );
        // $this->admin_model->logs_insert($data);
    
        redirect(base_url('research/edit/'.$publication_id));
    }

    public function export(){
        $data["ex"] = $this->admin_model->fetch_data();
        $data["completed"] = $this->admin_model->fetch_pdf_completed();
        $data["presented"] = $this->admin_model->fetch_pdf_presented();
        $data["published"] = $this->admin_model->fetch_pdf_published();
        $data["creative"] = $this->admin_model->fetch_pdf_creative();
        $data["authors"] = $this->admin_model->fetch_all_authors_admin();
        $data["editors"] = $this->admin_model->fetch_all_editors_admin();
        $this->load->view('template/header_archive');
        $this->load->view('urc/export', $data);
        $this->load->view('template/footer');
    }

    public function export_json(){
        $data["test"] = $this->admin_model->fetch_pdf_completed();
        //$result1 = $this->admin_model->fetch_json_completed();
        //$result2 = $this->admin_model->fetch_json_presented();
        //$result3 = $this->admin_model->fetch_json_published();
        //$result4 = $this->admin_model->fetch_json_creative();
        $result1 = $this->admin_model->fetch_json_user();
        $result2 = $this->admin_model->fetch_json_publication();
        $result3 = $this->admin_model->fetch_json_auth();
        $result4 = $this->admin_model->fetch_json_completed();
        $result5 = $this->admin_model->fetch_json_presented();
        $result6 = $this->admin_model->fetch_json_published();
        $result7 = $this->admin_model->fetch_json_creative();
        $result8 = $this->admin_model->fetch_json_editor();
        $result9 = $this->admin_model->fetch_json_comment();
        $result10 = $this->admin_model->fetch_json_like();
        $result11 = $this->admin_model->fetch_json_notif();
        $filepath = "./download/json_code.txt"; 

        if(write_file($filepath, $result1)){
            write_file($filepath, $result2, 'a');
            write_file($filepath, $result3, 'a');
            write_file($filepath, $result4, 'a');
            write_file($filepath, $result5, 'a');
            write_file($filepath, $result6, 'a');
            write_file($filepath, $result7, 'a');
            write_file($filepath, $result8, 'a');
            write_file($filepath, $result9, 'a');
            write_file($filepath, $result10, 'a');
            write_file($filepath, $result11, 'a');
            if(file_exists($filepath)){
                $filedata = file_get_contents($filepath);
                force_download($filepath, $filedata);
            }
        }else{
            $data["export_response"] = 'Error could not export json code';
        }
        $this->load->view('template/header');
        $this->load->view('urc/export', $data);
    }

    public function import_json(){
        //config for upload
        $config['upload_path'] = './assets/';
        $config['allowed_types'] = 'txt';
        $config['max_size'] = 0;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file')){
            //displays error if file not uploaded correctly
            $error = array('error' => $this->upload->display_errors());
            $data["completed"] = $this->admin_model->fetch_pdf_completed();
            $data["presented"] = $this->admin_model->fetch_pdf_presented();
            $data["published"] = $this->admin_model->fetch_pdf_published();
            $data["creative"] = $this->admin_model->fetch_pdf_creative();
            $data["authors"] = $this->admin_model->fetch_all_authors_admin();
            $this->load->view('template/header_archive');
            $this->load->view('urc/export', $error, $data);
        }else{
            //gets uploaded file
            $upload = $this->upload->data();
            $file_name = $upload['file_name'];
            $get_file = file_get_contents('./assets/'.$file_name.'');
            //decodes json contents in file
            $decode = json_decode($get_file, true);
            
            //must check if file is not null otherwise error will occur
            if($decode != NULL){
                foreach($decode as $row){

                    if(isset($row['username'])){
                        $array1 = array(
                            'user_id' => $row['user_id'],
                            'username' => $row['username'],
                            'first_name' => $row['first_name'],
                            'middle_name' => $row['middle_name'],
                            'last_name' => $row['last_name'],
                            'email' => $row['email'],
                            'password' => $row['password'],
                            'department' => $row['department'],
                            'contact_number' => $row['contact_number'],
                            'user_type' => $row['user_type']
                        );
                        $this->admin_model->import_user($array1);
                    }
                    if(isset($row['publication_type'])){
                        $array2 = array(
                            'publication_id' => $row['publication_id'],
                            'file' => $row['file'],
                            'abstract' => $row['abstract'],
                            'num_views' => $row['num_views'],
                            'status' => $row['status'],
                            'feedback' => $row['feedback'],
                            'publication_type' => $row['publication_type'],
                            'date_submission' => $row['date_submission'],
                            'submittor' => $row['submittor']
                        );
                        $this->admin_model->import_publication($array2);
                    }
                    if(isset($row['author_id'])){
                        $array3 = array(
                            'author_id' => $row['author_id'],
                            'user_id' => $row['user_id'],
                            'publication_id' => $row['publication_id'],
                            'first_name' => $row['first_name'],
                            'middle_initial' => $row['middle_initial'],
                            'last_name' => $row['last_name'],
                            'is_employee' => $row['is_employee'],
                            'author_type' => $row['author_type']
                        );
                        $this->admin_model->import_author($array3);
                    }
                    if(isset($row['completed_id'])){
                        $array4 = array(
                            'completed_id' => $row['completed_id'],
                            'publication_id' => $row['publication_id'],
                            'title' => $row['title'],
                            'year' => $row['year'],
                            'institution' => $row['institution'],
                            'location' => $row['location'],
                            'url' => $row['url'],
                            'completed_type' => $row['completed_type']
                        );
                        $this->admin_model->import_completed($array4);
                    }
                    if(isset($row['presented_id'])){
                        $array5 = array(
                            'presented_id' => $row['presented_id'],
                            'publication_id' => $row['publication_id'],
                            'title_presented' => $row['title_presented'],
                            'date_presentation' => $row['date_presentation'],
                            'title_conference' => $row['title_conference'],
                            'place_conference' => $row['place_conference'],
                            'presented_type' => $row['presented_type']
                        );
                        $this->admin_model->import_presented($array5);
                    }
                    if(isset($row['published_type'])){
                        $array6 = array(
                            'published_id' => $row['published_id'],
                            'publication_id' => $row['publication_id'],
                            'year_published' => $row['year_published'],
                            'title_article' => $row['title_article'],
                            'title_journal' => $row['title_journal'],
                            'vol_num' => $row['vol_num'],
                            'issue_num' => $row['issue_num'],
                            'page_num' => $row['page_num'],
                            'indexing_database' => $row['indexing_database'],
                            'peer_review' => $row['peer_review'],
                            'title_book' => $row['title_book'],
                            'title_chapter' => $row['title_chapter'],
                            'publisher' => $row['publisher'],
                            'place_of_publication' => $row['place_of_publication'],
                            'place_of_conference' => $row['place_of_conference'],
                            'published_type' => $row['published_type'],
                            'title_conference' => $row['title_conference'],
                            'url' => $row['url']
                        );
                        $this->admin_model->import_published($array6);
                    }
                    if(isset($row['cw_id'])){
                        $array7 = array(
                            'cw_id' => $row['cw_id'],
                            'publication_id' => $row['publication_id'],
                            'type_cw' => $row['type_cw'],
                            'month_year' => $row['month_year'],
                            'title_work' => $row['tile_work'],
                            'role' => $row['role'],
                            'place_perfomance' => $row['place_perfomance'],
                            'publisher' => $row['publisher'],
                            'artwork_exhibited' => $row['artwork_exhibited'],
                            'duration_performance' => $row['commission_agency'],
                            'scope_audience' => $row['scope_audience'],
                            'award_received' => $row['award_received']
                        );
                        $this->admin_model->import_creative($array7);
                    }
                    if(isset($row['editor_id'])){
                        $array8 = array(
                            'editor_id' => $row['editor_id'],
                            'published_id' => $row['published_id'],
                            'editor_fn' => $row['editor_fn'],
                            'editor_mi' => $row['editor_mi'],
                            'editor_ln' => $row['editor_ln']
                        );
                        $this->admin_model->import_editor($array8);
                    }
                    if(isset($row['comment_id'])){
                        $array9 = array(
                            'comment_id' => $row['comment_id'],
                            'publication_id' => $row['publication_id'],
                            'user_id' => $row['user_id'],
                            'message' => $row['message'],
                            'time_created' => $row['time_created']
                        );
                        $this->admin_model->import_comment($array9);
                    }
                    if(isset($row['like_id'])){
                        $array10 = array(
                            'like_id' => $row['like_id'],
                            'user_id' => $row['user_id'],
                            'publication_id' => $row['publication_id']
                        );
                        $this->admin_model->import_like($array10);
                    }
                    
                    if(isset($row['notification_id'])){
                        $array11 = array(
                            'notification_id' => $row['notification_id'],
                            'user_id' => $row['user_id'],
                            'publication_id' => $row['publication_id'],
                            'type' => $row['type'],
                            'time' => $row['time'],
                            'status' => $row['status']
                        );
                        $this->admin_model->import_notif($array11);
                    }

                    //$this->admin_model->import_json_all($array1, $array2, $array3, $array4, $array5, $array6, $array7, $array8, $array9, $array10, $array11);
                }
                $data['response'] = 'File has been imported.';
            }else{
                $data['response'] = 'File is not imported, Please try again.';
            }
            $data["completed"] = $this->admin_model->fetch_pdf_completed();
            $data["presented"] = $this->admin_model->fetch_pdf_presented();
            $data["published"] = $this->admin_model->fetch_pdf_published();
            $data["creative"] = $this->admin_model->fetch_pdf_creative();
            $data["authors"] = $this->admin_model->fetch_all_authors_admin();
            $data["editors"] = $this->admin_model->fetch_all_editors_admin();
            $this->load->view('template/header_archive');
            $this->load->view('urc/export', $data);
        }
    }

    public function pdfdetails(){ 
        $this->uri->segment(3);
        $html_content = $this->admin_model->fetch_download_pdf();
        $this->pdf->loadhtml($html_content);
        $this->pdf->render();
        $this->pdf->stream("aers_data.pdf", array("Attachment"=>0));
    }

    function export_excel(){
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->setTitle('Completed Research');
        $presented_sheet = new PHPExcel_WorkSheet($object, "Presented Research");
        $published_sheet = new PHPExcel_WorkSheet($object, "Published Research");
        $creative_sheet = new PHPExcel_WorkSheet($object, "Creative Works Research");
        $object->addSheet($presented_sheet, 1);
        $object->addSheet($published_sheet, 2);
        $object->addSheet($creative_sheet, 3);

        $completed_columns = array("Author Name(s)", "Title", "Year", "Institute", "Location", "Url", "Completed Type");
        $presented_columns = array("Author Name(s)", "Title Presented", "Date Presented", "Title of Conference", "Place of Conference", "Presented Type");
        $published_columns = array("Author Name(s)", "Published Type", "Title of Article", "Editor Name(s)", "Title of Journal", "Title of Book", "Title_Chapter", "Title of Conference", "Year Published", "Vol. Number", "Issue Number", "Page Number", "Indexing Database", "Peer Review", "Publisher", "Place of Publication", "Place of Conference", "URL");
        $creative_columns = array("Creator", "Type of Creative Work", "Date", "Title of Work", "Role", "Place of Performance/Exhibition/Publication", "Producer/Organizer/Publisher", "Number of Artworks Exhibited", "Duration of Performance/Exhibition", "Commissioning Agency", "Scope of Audience", "Award Received");
        
        $com_column = 0;
        $pre_column = 0;
        $pub_column = 0;
        $cre_column = 0;

        foreach($completed_columns as $field){
            $object->getActiveSheet()->setCellValueByColumnAndRow($com_column, 1, $field);
            $com_column++;
        }

        foreach($presented_columns as $field){
            $object->getSheet(1)->setCellValueByColumnAndRow($pre_column, 1, $field);
            $pre_column++;
        }

        foreach($published_columns as $field){
            $object->getSheet(2)->setCellValueByColumnAndRow($pub_column, 1, $field);
            $pub_column++;
        }

        foreach($creative_columns as $field){
            $object->getSheet(3)->setCellValueByColumnAndRow($cre_column, 1, $field);
            $cre_column++;
        }

        $completed_research_data = $this->admin_model->fetch_pdf_completed();
        $presented_research_data = $this->admin_model->fetch_pdf_presented();
        $published_research_data = $this->admin_model->fetch_pdf_published();
        $creative_research_data = $this->admin_model->fetch_pdf_creative();
        
        $com_row = 2;
        $pre_row = 2;
        $pub_row = 2;
        $cre_row = 2;


        foreach($completed_research_data as $row){
            $data = $this->admin_model->fetch_author_excel($row->publication_id);
            $string = array();
            $i = 0;
            foreach($data as $name){
                $string[$i] = $name->first_name . " " . $name->middle_initial . " " . $name->last_name;
                $i++;           
            }

            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $com_row, implode(', ', $string));
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $com_row, $row->title);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $com_row, $row->year);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $com_row, $row->institution);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $com_row, $row->location);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $com_row, $row->url);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $com_row, $row->completed_type);
            $com_row++;
        }

        foreach($presented_research_data as $row){
            $data = $this->admin_model->fetch_author_excel($row->publication_id);
            $string = array();
            $i = 0;
            foreach($data as $name){
                $string[$i] = $name->first_name . " " . $name->middle_initial . " " . $name->last_name;
                $i++;           
            }
            $object->getSheet(1)->setCellValueByColumnAndRow(0, $pre_row, implode(', ', $string));
            $object->getSheet(1)->setCellValueByColumnAndRow(1, $pre_row, $row->title_presented);
            $object->getSheet(1)->setCellValueByColumnAndRow(2, $pre_row, $row->date_presentation);
            $object->getSheet(1)->setCellValueByColumnAndRow(3, $pre_row, $row->title_conference);
            $object->getSheet(1)->setCellValueByColumnAndRow(4, $pre_row, $row->place_conference);
            $object->getSheet(1)->setCellValueByColumnAndRow(5, $pre_row, $row->presented_type);
            $pre_row++;
        }

        foreach($published_research_data as $row){
            $data = $this->admin_model->fetch_author_excel($row->publication_id);
            $data1 = $this->admin_model->fetch_all_editors_admin();
            $string = array();
            $i = 0;
            foreach($data as $name){
                $string[$i] = $name->first_name . " " . $name->middle_initial . " " . $name->last_name;
                $i++;           
            }
            $string1 = array();
            $x = 0;
            foreach($data1 as $ed){
                if($row->published_id == $ed->published_id){
                    $string1[$x] = $ed->editor_fn . " " . $ed->editor_mi . " " . $ed->editor_ln;
                    $x++;
                }
            }
            $object->getSheet(2)->setCellValueByColumnAndRow(0, $pub_row, implode(', ', $string));
            $object->getSheet(2)->setCellValueByColumnAndRow(1, $pub_row, $row->published_type);
            $object->getSheet(2)->setCellValueByColumnAndRow(2, $pub_row, $row->title_article);
            $object->getSheet(2)->setCellValueByColumnAndRow(3, $pub_row, implode(', ', $string1));
            $object->getSheet(2)->setCellValueByColumnAndRow(4, $pub_row, $row->title_journal);     
            $object->getSheet(2)->setCellValueByColumnAndRow(5, $pub_row, $row->title_book);
            $object->getSheet(2)->setCellValueByColumnAndRow(6, $pub_row, $row->title_chapter);
            $object->getSheet(2)->setCellValueByColumnAndRow(7, $pub_row, $row->title_conference);
            $object->getSheet(2)->setCellValueByColumnAndRow(8, $pub_row, $row->year_published);
            $object->getSheet(2)->setCellValueByColumnAndRow(9, $pub_row, $row->vol_num);
            $object->getSheet(2)->setCellValueByColumnAndRow(10, $pub_row, $row->issue_num);
            $object->getSheet(2)->setCellValueByColumnAndRow(11, $pub_row, $row->page_num);
            $object->getSheet(2)->setCellValueByColumnAndRow(12, $pub_row, $row->peer_review);
            $object->getSheet(2)->setCellValueByColumnAndRow(13, $pub_row, $row->publisher);
            $object->getSheet(2)->setCellValueByColumnAndRow(14, $pub_row, $row->place_of_publication);
            $object->getSheet(2)->setCellValueByColumnAndRow(15, $pub_row, $row->place_of_conference);
            $object->getSheet(2)->setCellValueByColumnAndRow(16, $pub_row, $row->url);
            $pub_row++;
        }

        foreach($creative_research_data as $row){
            $data = $this->admin_model->fetch_author_excel($row->publication_id);
            $string = array();
            $i = 0;
            foreach($data as $name){
                $string[$i] = $name->first_name . " " . $name->middle_initial . " " . $name->last_name;
                $i++;           
            }
            $object->getSheet(3)->setCellValueByColumnAndRow(0, $cre_row, implode(', ', $string));
            $object->getSheet(3)->setCellValueByColumnAndRow(1, $cre_row, $row->cw_type);
            $object->getSheet(3)->setCellValueByColumnAndRow(2, $cre_row, $row->month_year);
            $object->getSheet(3)->setCellValueByColumnAndRow(3, $cre_row, $row->title_work);
            $object->getSheet(3)->setCellValueByColumnAndRow(4, $cre_row, $row->role);
            $object->getSheet(3)->setCellValueByColumnAndRow(5, $cre_row, $row->place_performance);
            $object->getSheet(3)->setCellValueByColumnAndRow(6, $cre_row, $row->publisher);
            $object->getSheet(3)->setCellValueByColumnAndRow(7, $cre_row, $row->artwork_exhibited);
            $object->getSheet(3)->setCellValueByColumnAndRow(8, $cre_row, $row->duration_performance);
            $object->getSheet(3)->setCellValueByColumnAndRow(9, $cre_row, $row->commission_agency);
            $object->getSheet(3)->setCellValueByColumnAndRow(10, $cre_row, $row->scope_audience);
            $object->getSheet(3)->setCellValueByColumnAndRow(11, $cre_row, $row->award_received);
            $cre_row++;
        }

        //adjust column width depending on string size of a cell
        foreach($object->getWorksheetIterator() as $row){
            $object->setActiveSheetIndex($object->getIndex($row));
            $sheet = $object->getActiveSheet();
            $cell_ite = $sheet->getRowIterator()->current()->getCellIterator();
            $cell_ite->setIterateOnlyExistingCells(true);
            foreach($cell_ite as $cell){
                $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
            }
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="URC_Data.xls"');
        $object_writer->save('php://output');
    }
}

?>