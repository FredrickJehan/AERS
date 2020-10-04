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

    //fetchs completed research similar to query
    public function search_completed($query){
        //$this->db->select('c.title, c.year, p.file, a.first_name, a.middle_initial, a.last_name  ');
        //$this->db->from('completed AS c, publication AS p, author AS a');
        $this->db->select('*');
        $this->db->from('completed AS c');
        $this->db->join('publication AS p', 'p.publication_id = c.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id');
        if($query != ''){
            $this->db->like('c.title', $query);
            $this->db->or_like('c.year', $query);
            $this->db->or_like('c.institution', $query);
            $this->db->or_like('c.location', $query);
            $this->db->or_like('a.first_name', $query);
            $this->db->or_like('a.middle_initial', $query);
            $this->db->or_like('a.last_name', $query);
        }
        $this->db->order_by('p.publication_id', 'DESC');
        return $this->db->get();
    }

    //fetchs presented research similar to query
    public function search_presented($query){     
        $this->db->from('presented AS pr');
        $this->db->join('publication AS p', 'p.publication_id = pr.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id'); 
        if($query != ''){
            $this->db->like('pr.title_presented', $query);
            $this->db->or_like('pr.date_presentation', $query);
            $this->db->or_like('pr.title_conference', $query);
            $this->db->or_like('pr.place_conference', $query);
            $this->db->or_like('a.first_name', $query);
            $this->db->or_like('a.middle_initial', $query);
            $this->db->or_like('a.last_name', $query);
        }
        $this->db->order_by('p.publication_id', 'DESC');
        return $this->db->get();
    }

    public function fetch_data(){
        $this->db->order_by("completed_id", "ASC");
        $query = $this->db->get("completed");
        return $query->result();
    }

    /*
    public function fetch_json_completed(){
        //$this->db->select('*');
        $this->db->select('completed.completed_id, completed.publication_id, completed.title, completed.year, completed.institution, completed.location, completed.url, completed.completed_type,
        publication.publication_id, publication.file, publication.abstract, publication.num_views, publication.status, publication.feedback, publication.publication_type, publication.date_submission, publication.submittor,
        author.author_id, author.user_id, author.publication_id, author.first_name, author.middle_initial, author.last_name, author.is_employee, author.author_type, 
        user.user_id, user.username, user.first_name AS fname, user.middle_name, user.last_name AS lname, user.email, user.password, user.department, user.contact_number, user.user_type');
        $this->db->from('completed');
        //$this->db->join('publication AS p', 'p.publication_id = c.publication_id', 'inner');
        //$this->db->join('author AS a', 'a.publication_id = p.publication_id', 'inner');
        //$this->db->join('user AS u', 'u.user_id = a.user_id', 'inner');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        //$this->db->join('like_tbl', 'like_tbl.user_id = user.user_id', 'right');
        //$this->db->join('comment', 'comment.publication_id = publication.publication_id', 'right');
        //$this->db->join('notification', 'notification.publication_id = publication.publication_id', 'right');

        $this->db->order_by('publication.publication_id', 'ASC');
        //$this->db->group_by('title');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_presented(){
        //$this->db->select('*');
        $this->db->select('presented.presented_id, presented.publication_id, presented.title_presented, presented.date_presentation, presented.title_conference, presented.place_conference, presented.presented_type,        
        publication.publication_id, publication.file, publication.abstract, publication.num_views, publication.status, publication.feedback, publication.publication_type, publication.date_submission, publication.submittor,
        author.author_id, author.user_id, author.publication_id, author.first_name, author.middle_initial, author.last_name, author.is_employee, author.author_type, 
        user.user_id, user.username, user.first_name AS fname, user.middle_name, user.last_name AS lname, user.email, user.password, user.department, user.contact_number, user.user_type');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        //$this->db->join('like_tbl AS lb', 'lb.user_id = u.user_id', 'inner');
        //$this->db->join('comment AS com', 'com.publication_id = p.publication_id', 'inner');
        $this->db->order_by('publication.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_published(){
        $this->db->select('published.published_id, published.publication_id, published.year_published, published.title_article, published.title_journal, published.vol_num, published.issue_num, published.page_num, published.indexing_database, published.peer_review, 
        published.title_book, published.title_chapter, published.publisher, published.place_of_publication, published.place_of_conference, published.published_type, published.title_conference, published.url,         
        publication.publication_id, publication.file, publication.abstract, publication.num_views, publication.status, publication.feedback, publication.publication_type, publication.date_submission, publication.submittor,
        editor.editor_id, editor.published_id, editor.editor_fn, editor.editor_mi, editor.editor_ln,
        author.author_id, author.user_id, author.publication_id, author.first_name, author.middle_initial, author.last_name, author.is_employee, author.author_type, 
        user.user_id, user.username, user.first_name AS fname, user.middle_name, user.last_name AS lname, user.email, user.password, user.department, user.contact_number, user.user_type');
        $this->db->from('published');
        $this->db->join('publication', 'publication.publication_id = published.publication_id', 'inner');
        $this->db->join('editor', 'editor.published_id = published.published_id', 'right');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        //$this->db->join('like_tbl AS lb', 'lb.user_id = u.user_id', 'inner');
        //$this->db->join('comment AS co', 'co.publication_id = p.publication_id', 'inner');
        $this->db->order_by('publication.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_creative(){
        $this->db->select('creative_works.cw_id, creative_works.publication_id, creative_works.type_cw, creative_works.month_year, creative_works.title_work, creative_works.role, creative_works.place_performance, creative_works.publisher, creative_works.artwork_exhibited,
        creative_works.duration_performance, creative_works.commission_agency, creative_works.scope_audience, creative_works.award_received,        
        publication.publication_id, publication.file, publication.abstract, publication.num_views, publication.status, publication.feedback, publication.publication_type, publication.date_submission, publication.submittor,
        author.author_id, author.user_id, author.publication_id, author.first_name, author.middle_initial, author.last_name, author.is_employee, author.author_type, 
        user.user_id, user.username, user.first_name AS fname, user.middle_name, user.last_name AS lname, user.email, user.password, user.department, user.contact_number, user.user_type');
        $this->db->from('creative_works');
        $this->db->join('publication', 'publication.publication_id = creative_works.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        //$this->db->join('like_tbl AS lb', 'lb.user_id = u.user_id', 'inner');
        //$this->db->join('comment AS com', 'com.publication_id = p.publication_id', 'inner');
        $this->db->order_by('publication.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }
    */

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

    /*
    public function import_completed($user_array, $author_array, $publication_array, $array){
        $user_query = $this->import_user_check($user_array);
        //$author_query = $this->import_author_check($author_array);
        $publication_query = $this->import_publication_check($publication_array);
        //$completed_query = $this->import_completed_check($array);
        if(count($user_query) == 0){
            $this->db->insert('user', $user_array);
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('completed', $array);
        }elseif(count($publication_query) == 0){
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('completed', $array);
        }else{
            $this->db->where('completed_id', $array['completed_id']);
            $this->db->update('completed', $array);
            $this->db->where('author_id', $author_array['author_id']);
            $this->db->update('author', $author_array);
            $this->db->where('publication_id', $publication_array['publication_id']);
            $this->db->update('publication', $publication_array);
            $this->db->where('user_id', $user_array['user_id']);
            $this->db->update('user', $user_array);
        }
    }

    public function import_presented($user_array, $author_array, $publication_array, $array){
        $user_query = $this->import_user_check($user_array);
        //$author_query = $this->import_author_check($author_array);
        $publication_query = $this->import_publication_check($publication_array);
        //$presented_query = $this->import_presented_check($array);
        if(count($user_query) == 0){
            $this->db->insert('user', $user_array);
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('presented', $array);
        }elseif(count($publication_query) == 0){
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('presented', $array);
        }else{
            $this->db->where('presented_id', $array['presented_id']);
            $this->db->update('presented', $array);
            $this->db->where('author_id', $author_array['author_id']);
            $this->db->update('author', $author_array);
            $this->db->where('publication_id', $publication_array['publication_id']);
            $this->db->update('publication', $publication_array);
            $this->db->where('user_id', $user_array['user_id']);
            $this->db->update('user', $user_array);
        }
    }

    public function import_published($user_array, $author_array, $publication_array, $array, $editor_array){
        $user_query = $this->import_user_check($user_array);
        //$author_query = $this->import_author_check($author_array);
        $publication_query = $this->import_publication_check($publication_array);
        $editor_query = $this->import_editor_check($editor_array);
        //$published_query = $this->import_published_check($array);
        if(count($user_query) == 0){
            $this->db->insert('user', $user_array);
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('published', $array);
            if(!empty($editor_array)){
                $this->db->insert('editor', $editor_array);
            }
        }elseif(count($publication_query) == 0){
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('published', $array);
            if(!empty($editor_array)){
                $this->db->insert('editor', $editor_array);
            }
        }else{
            if(!empty($editor_array)){
                $this->db->where('editor_id', $editor_array['editor_id']);
                $this->db->update('published', $editor_array);
            }
            $this->db->where('published_id', $array['published_id']);
            $this->db->update('published', $array);
            $this->db->where('author_id', $author_array['author_id']);
            $this->db->update('author', $author_array);
            $this->db->where('publication_id', $publication_array['publication_id']);
            $this->db->update('publication', $publication_array);
            $this->db->where('user_id', $user_array['user_id']);
            $this->db->update('user', $user_array);
        }
    }

    public function import_creative($user_array, $author_array, $publication_array, $array){
        $user_query = $this->import_user_check($user_array);
        //$author_query = $this->import_author_check($author_array);
        $publication_query = $this->import_publication_check($publication_array);
        //$published_query = $this->import_creative_check($array);
        if(count($user_query) == 0){
            $this->db->insert('user', $user_array);
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('creative_works', $array);
        }elseif(count($publication_query) == 0){
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('creative_works', $array);
        }else{
            $this->db->where('cw_id', $array['cw_id']);
            $this->db->update('creative_works', $array);
            $this->db->where('author_id', $author_array['author_id']);
            $this->db->update('author', $author_array);
            $this->db->where('publication_id', $publication_array['publication_id']);
            $this->db->update('publication', $publication_array);
            $this->db->where('user_id', $user_array['user_id']);
            $this->db->update('user', $user_array);
        }
    }
    */

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

    /*
        //Get table contents for import
        public function import_user_check($data){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user_id', $data['user_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_publication_check($data){
            $this->db->select('*');
            $this->db->from('publication');
            $this->db->where('publication_id', $data['publication_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
        
        public function import_author_check($data){
            $this->db->select('*');
            $this->db->from('author');
            $this->db->where('author_id', $data['author_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_completed_check($data){
            $this->db->select('*');
            $this->db->from('completed');
            $this->db->where('completed_id', $data['completed_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_presented_check($data){
            $this->db->select('*');
            $this->db->from('presented');
            $this->db->where('presented_id', $data['presented_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_published_check($data){
            $this->db->select('*');
            $this->db->from('published');
            $this->db->where('published_id', $data['published_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_creative_check($data){
            $this->db->select('*');
            $this->db->from('creative_works');
            $this->db->where('cw_id', $data['cw_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_comment_check($data){
            $this->db->select('*');
            $this->db->from('comment');
            $this->db->where('comment_id', $data['comment_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_notification_check($data){
            $this->db->select('*');
            $this->db->from('notification');
            $this->db->where('notification_id', $data['notification_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_like_tbl_check($data){
            $this->db->select('*');
            $this->db->from('like_tbl');
            $this->db->where('like_id', $data['like_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function import_editor_check($data){
            $this->db->select('*');
            $this->db->from('editor');
            $this->db->where('editor_id', $data['editor_id']);
            $query = $this->db->get();
            return $query->result_array();
        }
        //End of get table contents
    */

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
        $output ='
            <table width="100%" cellspacing="5" cellpadding="5">
        ';
        $output .='
        <tr>
            <p><b><th width="20%">Author</th></b></p>
            <p><b><th width="20%">Department</th></b></p> 
            <p><b><th width="10%">Type of Research</th></b></p>
            <p><b><th width="50%">Citation</th></b></p>
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
                        <td width="20%">'.implode(', ', $string).'</td>
                        <td width="20%">'.$row->department.'</td>
                        <td width="10%">'.$row->publication_type.'</td>
                    ';
        if(!empty($row->url)){
        $output .='    
                    <td width="50%">
                    '.implode(', ', $string).'('.$row->year.').
                    <i>'.$row->title.'</i>. '.$row->location.': '.$row->institution.'. Retrieved from '.$row->url.'
                    </td>
            ';    
        }else{
        $output .='
                    <td width="50%">
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
                    <td width="20%">'.implode(', ', $string).'</td>
                    <td width="20%">'.$row->department.'</td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="50%">
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
                    <td width="20%">'.implode(', ', $string).'</td>
                    <td width="20%">'.$row->department.'</td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="50%">
                ';
                if($row->publication_type == 'Journal Article'){
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
                    <td width="20%">';
                    if(isset($name->middle_initial)){
                $output .=''.$row->first_name.' '.$row->middle_initial.' '.$row->last_name.'';
                    }else{
                $output .=''.$row->first_name.' '.$row->last_name.'';
                    }
                $output .='    
                    </td>
                    <td width="20%">'.$row->department.'</td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="50%">
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