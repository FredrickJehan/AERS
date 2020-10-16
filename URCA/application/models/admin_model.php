<?php
class admin_model extends CI_Model{

    public function get_Receiver_id($publication_id){
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('publication', $publication_id);
        return $this->db->get()->row()->user_id;
    }

    function send_notif($data2){
        $this->db->insert('notification', $data2);
    }

    public function total_pub_count(){
        $this->db->select('*');
        $this->db->from('publication');
        return $this->db->get()->num_rows();
    }

    public function unreviewed_count(){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->where('status', 'Unreviewed');
        return $this->db->get()->num_rows();
    }

    public function approved_count(){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->where('status', 'Approved');
        return $this->db->get()->num_rows();
    }

    public function rejected_count(){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->where('status', 'Rejected');
        return $this->db->get()->num_rows();
    }

    public function current_user($username){
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('username', $username);
        return $this->db->get()->row()->user_id;
    }

    function publication_select_unreviewed(){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'author_type' => 'Main',
            'status' => 'Unreviewed'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    function publication_select_approved(){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    function publication_select_rejected(){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'author_type' => 'Main',
            'status' => 'Rejected'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    public function select_admin_id($username){
        //inner w/o null, outer wilth null, left outer , right outer
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('username', $username);
        return $this->db->get()->row()->user_id;
    }

    public function logs_insert($data){
        $this->db->insert('log', $data);
    }

    function publication_review($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update('publication', $data);
    }

    public function fetch_data(){
        $this->db->order_by("completed_id", "ASC");
        $query = $this->db->get("completed");
        return $query->result();
    }

    public function fetch_json_user(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('user_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_publication(){
        $this->db->select('publication.publication_id, publication.file, publication.abstract, publication.num_views, publication.status, publication.feedback, publication.publication_type, publication.date_submission, publication.submittor,
        user.user_id');
        $this->db->from('publication');
        $this->db->join('user', 'user.user_id = publication.submittor', 'inner');
        $this->db->order_by('publication.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_auth(){
        $this->db->select('author.author_id, author.user_id, author.publication_id, author.first_name, author.middle_initial, author.last_name, author.is_employee, author.author_type,
        publication.publication_id, user.user_id');
        $this->db->from('author');
        $this->db->join('publication', 'publication.publication_id = author.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $this->db->order_by('author.author_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_completed(){
        $this->db->select('completed.completed_id, completed.publication_id, completed.title, completed.year, completed.institution, completed.location, completed.url, completed.completed_type,
        publication.publication_id');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->order_by('completed.completed_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_presented(){
        $this->db->select('presented.presented_id, presented.publication_id, presented.title_presented, presented.date_presentation, presented.title_conference, presented.place_conference, presented.presented_type,        
        publication.publication_id');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->order_by('presented.presented_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_published(){
        $this->db->select('published.published_id, published.publication_id, published.year_published, published.title_article, published.title_journal, published.vol_num, published.issue_num, published.page_num, published.indexing_database, published.peer_review, 
        published.title_book, published.title_chapter, published.publisher, published.place_of_publication, published.place_of_conference, published.published_type, published.title_conference, published.url,         
        publication.publication_id');
        $this->db->from('published');
        $this->db->join('publication', 'publication.publication_id = published.publication_id', 'inner');
        $this->db->order_by('published.published_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_creative(){
        $this->db->select('creative_works.cw_id, creative_works.publication_id, creative_works.type_cw, creative_works.month_year, creative_works.title_work, creative_works.role, creative_works.place_performance, creative_works.publisher, creative_works.artwork_exhibited,
        creative_works.duration_performance, creative_works.commission_agency, creative_works.scope_audience, creative_works.award_received,        
        publication.publication_id');
        $this->db->from('creative_works');
        $this->db->join('publication', 'publication.publication_id = creative_works.publication_id', 'inner');
        $this->db->order_by('creative_works.cw_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_editor(){
        $this->db->select('editor.editor_id, editor.published_id, editor.editor_fn, editor.editor_mi, editor.editor_ln, published.published_id');
        $this->db->from('editor');
        $this->db->join('published', 'published.published_id = editor.published_id', 'inner');
        $this->db->order_by('editor.editor_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_comment(){
        $this->db->select('comment.comment_id, comment.publication_id, comment.user_id, comment.message, comment.time_created, publication.publication_id, user.user_id');
        $this->db->from('comment');
        $this->db->join('publication', 'publication.publication_id = comment.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = comment.user_id', 'inner');
        $this->db->order_by('comment.comment_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_like(){
        $this->db->select('like_tbl.like_id, like_tbl.user_id, like_tbl.publication_id, publication.publication_id, user.user_id');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = like_tbl.user_id', 'inner');
        $this->db->order_by('like_tbl.like_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_notif(){
        $this->db->select('notification.notification_id, notification.user_id, notification.publication_id, notification.type, notification.time, notification.status, publication.publication_id, user.user_id');
        $this->db->from('notification');
        $this->db->join('publication', 'publication.publication_id = notification.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = notification.user_id', 'inner');
        $this->db->order_by('notification.notification_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_pdf_completed(){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $array = array(
            'author_type' => 'Main'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    public function fetch_pdf_presented(){
        $this->db->select('*');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $array = array(
            'author_type' => 'Main'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    public function fetch_pdf_published(){
        $this->db->select('*');
        $this->db->from('published');
        $this->db->join('publication', 'publication.publication_id = published.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $array = array(
            'author_type' => 'Main'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    public function fetch_pdf_creative(){
        $this->db->select('*');
        $this->db->from('creative_works');
        $this->db->join('publication', 'publication.publication_id = creative_works.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $array = array(
            'author_type' => 'Main'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    //Begin of import insert
    public function import_json_all($data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11){
        if($data1 != NULL){
            $this->db->insert('user', $data1);
        }
        if($data1 != NULL){
            $this->db->insert('publication', $data2);
        }
        if($data1 != NULL){
            $this->db->insert('author', $data3);
        }
        if($data1 != NULL){
            $this->db->insert('completed', $data4);
        }
        if($data1 != NULL){
            $this->db->insert('presented', $data5);
        }
        if($data1 != NULL){
            $this->db->insert('published', $data6);
        }
        if($data1 != NULL){
            $this->db->insert('creative_works', $data7);
        }
        if($data1 != NULL){
            $this->db->insert('editor', $data8);
        }
        if($data1 != NULL){
            $this->db->insert('comment', $data9);
        }
        if($data1 != NULL){
            $this->db->insert('like_tbl', $data10);
        }
        if($data1 != NULL){
            $this->db->insert('notification', $data11);
        }

    }

    public function import_user($data){
        $this->db->insert('user', $data);
    }

    public function import_publication($data){
        $this->db->insert('publication', $data);
    }

    public function import_author($data){
        $this->db->insert('author', $data);
    }

    public function import_completed($data){
        $this->db->insert('completed', $data);
    }

    public function import_presented($data){
        $this->db->insert('presented', $data);
    }

    public function import_published($data){
        $this->db->insert('published', $data);
    }

    public function import_creative($data){
        $this->db->insert('creative_works', $data);
    }

    public function import_editor($data){
        $this->db->insert('editor', $data);
    }

    public function import_notif($data){
        $this->db->insert('notification', $data);
    }

    public function import_like($data){
        $this->db->insert('like_tbl', $data);
    }

    public function import_comment($data){
        $this->db->insert('comment', $data);
    }
    //End of import insert 

    public function fetch_all_authors_admin(){
        $this->db->select('*');
        $this->db->from('author');
        return $this->db->get()->result();
    }

    public function fetch_all_editors_admin(){
        $this->db->select('*');
        $this->db->from('editor');
        return $this->db->get()->result();
    }

    public function fetch_author_excel($publication_id){
        $this->db->select('*');
        $this->db->from('author');
        $this->db->where('publication_id', $publication_id);
        $this->db->order_by('publication_id', 'DESC');
        //$this->db->query("SELECT CONCAT_WS(' ', 'first_name', 'middle_initial', 'last_name') FROM author WHERE publication_id='$publication_id';");
        
        return $this->db->get()->result();
    }


    public function fetch_download_pdf(){
        $comp = $this->fetch_pdf_completed();
        $pre = $this->fetch_pdf_presented();
        $pub = $this->fetch_pdf_published();
        $cre = $this->fetch_pdf_creative();
        $authors = $this->fetch_all_authors_admin();
        $editors = $this->fetch_all_editors_admin();
        date_default_timezone_set('Asia/Karachi');
        $date = date('M d Y');
        $output ='
                <div class="row">
                    <img src="./gueststyle/img/logo_new.png" style="height: 70px;"/>
                </div>
                <br/>
                <hr/>
                <div class="row">
                    <p>Date: '.$date.'</p>
                    <p>To: All Employees</p>
                    <p>From: Office for Research and Creative Endeavors</p>
                    <p>Subject: Borrowing Research Report</p>
                </div>
                <div class="row">
                    <p>The Office for Research and Creative Endeavors(ORCE) will give permission to employees
                    for borrowing research data owned by the Ateneo de Naga University upon approval by the
                    head of ORCE. The employee will be held responsible for the privacy of said data and will be
                    held responsible for unauthorized disclosure of information.</p>
                </div>
            <p>The following are research data of Ateneo de naga University: </p>
            <table width="100%" cellspacing="5" cellpadding="5" style="text-align: left;">
        ';
        $output .='
        <tr>
            <p><b><th width="20%" style="text-align: left;">Department</th></b></p>
            <p><b><th width="20%" style="text-align: left;">Research Type</th></b></p> 
            <p><b><th width="20%" style="text-align: left;">Publication Type</th></b></p>
            <p><b><th width="40%" style="text-align: left;">Citation</th></b></p>
        </tr>
        ';

        //completed research data
        if(!empty($comp)){
            foreach($comp as $row){
                $string = array();
                $i = 0;
                foreach($authors as $name){
                    if($row->publication_id == $name->publication_id){
                        if(isset($name->middle_initial)){
                            $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                        }else{
                            $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                        }
                        $i++;
                    }
                }
        $output .='
                    <tr>
                        <td width="20%" style="text-align: left;">'.$row->department.'</td>
                        <td width="10%">'.$row->publication_type.'</td>
                        <td width="20%">'.$row->completed_type.'</td>
                    ';
        if(!empty($row->url)){
        $output .='    
                    <td width="50%" style="text-align: left;">
                    '.implode(', ', $string).'('.$row->year.').
                    <i>'.$row->title.'</i>. '.$row->location.': '.$row->institution.'. Retrieved from '.$row->url.'
                    </td>
            ';    
        }else{
        $output .='
                    <td width="50%" style="text-align: left;">
                    '.implode(', ', $string).'('.$row->year.'). 
                    <i>'.$row->title.'</i>. '.$row->location.': '.$row->institution.'.
                    </td>
                ';
        }
        $output .='
                    </tr>
        ';
            }
        }

        //Presented research data
        if(!empty($pre)){
            foreach($pre as $row){
                $string = array();
                $i = 0;
                foreach($authors as $name){
                    if($row->publication_id == $name->publication_id){
                        if(isset($name->middle_initial)){
                            $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                        }else{
                            $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                        }
                        $i++;
                    }
                }
                $date = date_create("$row->date_presentation");
                $output .='
                <tr>
                    <td width="20%" style="text-align: left;">'.$row->department.'</td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="20%">'.$row->presented_type.'</td>
                    <td width="50%" style="text-align: left;">
                        '.implode(', ', $string).'('.date_format($date, 'Y').', '.date_format($date, 'F').'). 
                        <i>'.$row->title_presented.'</i>. '.$row->title_conference.': '.$row->place_conference.'.
                    </td>
                </tr>    
                ';    
            }
        }

        //Published research data
        if(!empty($pub)){
            foreach($pub as $row){
                $string = array();
                $i = 0;
                foreach($authors as $name){
                    if($row->publication_id == $name->publication_id){
                        if(isset($name->middle_initial)){
                            $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                        }else{
                            $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                        }
                        $i++;
                    }
                }
                $string_ed = array();
                $x = 0;
                foreach($editors as $ed){
                  if($row->published_id == $ed->published_id){
                    if(isset($ed->editor_mi)){
                      $string_ed[$x] = substr($ed->editor_fn, 0, 1) . ". " . $ed->editor_mi . " " . $ed->editor_ln; 
                    }else{
                      $string_ed[$x] = substr($ed->editor_fn, 0, 1) . ". " . $ed->editor_ln; 
                    }
                    $x++;
                  }
                }
                $output .='
                <tr>
                    <td width="20%" style="text-align: left;">'.$row->department.'</td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="20%">'.$row->published_type.'</td>
                    <td width="50%" style="text-align: left;">
                ';
                if($row->published_type == 'Journal Article'){
                $output .='
                        '.implode(', ', $string).'('.$row->year_published.'). '.$title_article.'
                        <i>'.$row->title_journal.'</i>. '.$row->vol_num.'';if(isset($row->issue_num)){$output .='('.$row->issue_num.'), ';
                        }else{$output .=', ';} $output .=''.$row->page_num.'';
                $output .='
                    </td>
                </tr>
                ';
                }elseif($row->published_type == 'Book / Textbook'){
                $output .='
                        '.implode(', ', $string).'('.$row->year_published.').
                        <i>'.$row->title_book.'</i>. '.$row->place_of_publication.':'.$row->publisher.'.';
                $output .='
                    </td>
                </tr>
                ';
                }elseif($row->published_type == 'Book Chapter'){
                $output .='
                        '.implode(', ', $string).'('.$row->year_published.'). '.$row->title_chapter.'. In '.implode(', ', $string_ed).'(Eds),  
                        <i>'.$row->title_book.'</i>(pp. '.$row->page_num.'). '.$row->place_of_publication.':'.$row->publisher.'.'; 
                $output .='
                    </td>
                </tr>
                ';
                }else{
                $output .='
                    '.implode(', ', $string).'('.$row->year_published.'). '.$row->title_chapter.'. In '.implode(', ', $string_ed).'(Eds), 
                    <i>'.$row->title_book.'</i>(pp. '.$row->page_num.'). '.$row->place_of_publication.':'.$row->publisher.''; 
                    if(isset($row->url)){
                        $output .='.Retrieved from '.$row->url.'';
                    }else{
                        $output .='.';
                    }
                $output .='
                    </td>
                </tr>
                ';
                }
            }
        }
        
        if(!empty($cre)){
            foreach($cre as $row){
                $output .='
                <tr>
                    <td width="20%" style="text-align: left;">'.$row->department.'</td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="20%">'.$row->type_cw.'</td>
                    <td width="50%" style="text-align: left;">
                ';
                if(isset($row->middle_initial)){
                    $output .=''.$row->title_work.' by '.$row->last_name.', '.substr($row->first_name, 0, 1).'. '.$row->middle_initial.'';
                }else{
                    $output .=''.$row->title_work.' by '.$row->last_name.', '.substr($row->first_name, 0, 1).'.';
                }
            }
            $output .='
                </td>
            </tr>
            ';
        }
        $output .='
            </table>
        ';
        return $output;
    }
}
?>