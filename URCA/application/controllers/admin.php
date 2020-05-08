<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller{
 
    public function __construct() {
    parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        $this->load->library('Pdf.php');
        $this->load->helper('file');
        $this->load->database();
    }
    
    public function index(){
        $this->load->view('template/header');
		$this->load->view('urc/dashboard');
        $this->load->view('template/footer');
    }

    public function get_admin_id(){
        $username = $this->session->userdata['logged_in']['username'];
        return $admin_id = $this->admin_model->select_admin_id($username);
    }

    public function manage_submissions(){
        $data["publication_unapproved"] = $this->admin_model->publication_select_unapproved();
        $this->load->view('template/header');
		$this->load->view('urc/manage', $data);
        $this->load->view('template/footer');
    }

    public function review(){
        //status = 0 if unreviewd, 1 if rejected, 2 if approved
        $publication_id = $this->uri->segment(3); //display approve_submissions url
        // $this->form_validation->set_rules('feedback', 'feedback', 'required');
        if($this->input->post('feedback') == ''){
            //apprive
            $data = array(
                'status' => '2'
            );
           $this->admin_model->publication_review($data, $publication_id);
        }else{
            //reject
            $data = array(
                'status' => '1'
            );
            $this->admin_model->publication_review($data, $publication_id);
        }
        //data for logs
        date_default_timezone_set('Asia/Karachi');
        $now = date('Y-m-d H:i:s');
        $data = array(
            'admin_id' => $this->get_admin_id(),
            'feedback' => $this->input->post('feedback'),
            'time' => $now,
            'publication_id' => $publication_id
        );
        $this->admin_model->logs_insert($data);
    
        redirect(base_url('research/view/'.$publication_id));
    }

    public function export(){
        $data["ex"] = $this->admin_model->fetch_data();
        $data["test"] = $this->admin_model->fetch_pdf_completed();
        $this->load->view('template/header');
		$this->load->view('urc/export', $data);
    }

    public function pdfdetails(){ 
        $this->uri->segment(3);
        $html_content = $this->admin_model->fetch_download_pdf();
        $this->pdf->loadhtml($html_content);
        $this->pdf->render();
        $this->pdf->stream("aers_data.pdf", array("Attachment"=>0));
    }

    public function export_excel(){
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Completed ID", "Publication ID", "Title", "Year", "Institute", "Location", "Url", "Completed Type");

        $column = 0;

        foreach($table_columns as $field){
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $completed_research_data = $this->admin_model->fetch_data();
        
        $excel_row = 2;

        foreach($completed_research_data as $row){
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->completed_id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->publication_id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->title);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->year);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->institution);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->location);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->url);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->completed_type);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Search_Data.xls"');
        $object_writer->save('php://output');
    }

    public function export_json(){
        $data["test"] = $this->admin_model->fetch_pdf_completed();
        $result = $this->admin_model->fetch_json_completed();
        if(write_file('json_file.json', $result)){
            $this->load->view('template/header');
            $this->load->view('urc/export', $data);
        }
    }
}

?>