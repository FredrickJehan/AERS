<?php
class research_model extends CI_Model{

    //inner w/o null, outer wilth null, left outer , right outer
    public function current_user($username){
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('username', $username);
        return $this->db->get()->row()->user_id;
    }

    public function most_likes_completed() {
        $this->db->select('like_tbl.publication_id, COUNT(like_tbl.user_id) as total, completed.title');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('completed', 'completed.publication_id = publication.publication_id', 'inner');
        $this->db->group_by('publication_id');
        $this->db->order_by('total', 'DESC');
        return $this->db->get();
    }

    public function most_likes_presented() {
        $this->db->select('like_tbl.publication_id, COUNT(like_tbl.user_id) as total, presented.title_presented');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('presented', 'presented.publication_id = publication.publication_id', 'inner');
        $this->db->group_by('publication_id');
        $this->db->order_by('total', 'DESC');
        return $this->db->get();
    }

    public function most_likes_published() {
        $this->db->select('like_tbl.publication_id, COUNT(like_tbl.user_id) as total, published.title_article');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('published', 'published.publication_id = publication.publication_id', 'inner');
        $this->db->group_by('publication_id');
        $this->db->order_by('total', 'DESC');
        return $this->db->get();
    }

    public function most_likes_creative() {
        $this->db->select('like_tbl.publication_id, COUNT(like_tbl.user_id) as total, creative_works.title_work');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('creative_works', 'creative_works.publication_id = publication.publication_id', 'inner');
        $this->db->group_by('publication_id');
        $this->db->order_by('total', 'DESC');
        return $this->db->get();
    }

    public function most_likes() {
        $this->db->select('publication_id, COUNT(user_id) as total');
        $this->db->from('like_tbl', 10);
        $this->db->group_by('publication_id');
        $this->db->order_by('total', 'DESC');
        return $this->db->get();
    }

    public function get_like_completed($user_id) {
        $this->db->select('like_tbl.publication_id, COUNT(like_tbl.user_id) as total, completed.title');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('completed', 'completed.publication_id = publication.publication_id', 'inner');
        $this->db->group_by('like_tbl.publication_id');
        $this->db->where('like_tbl.user_id', $user_id);
        // $this->db->order_by('user_id', 'DESC');
        return $this->db->get();
    }

    public function get_like_presented($user_id) {
        $this->db->select('like_tbl.publication_id, COUNT(like_tbl.user_id) as total, presented.title_presented');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('presented', 'presented.publication_id = publication.publication_id', 'inner');
        $this->db->group_by('like_tbl.publication_id');
        $this->db->where('like_tbl.user_id', $user_id);
        // $this->db->order_by('user_id', 'DESC');
        return $this->db->get();
    }

    public function get_like_published($user_id) {
        $this->db->select('like_tbl.publication_id, COUNT(like_tbl.user_id) as total, published.title_article');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('published', 'published.publication_id = publication.publication_id', 'inner');
        $this->db->group_by('like_tbl.publication_id');
        $this->db->where('like_tbl.user_id', $user_id);
        // $this->db->order_by('user_id', 'DESC');
        return $this->db->get();
    }

    public function get_like_creative($user_id) {
        $this->db->select('like_tbl.publication_id, COUNT(like_tbl.user_id) as total, creative_works.title_work');
        $this->db->from('like_tbl');
        $this->db->join('publication', 'publication.publication_id = like_tbl.publication_id', 'inner');
        $this->db->join('creative_works', 'creative_works.publication_id = publication.publication_id', 'inner');
        $this->db->group_by('like_tbl.publication_id');
        $this->db->where('like_tbl.user_id', $user_id);
        // $this->db->order_by('user_id', 'DESC');
        return $this->db->get();
    }

    // public function get_like_research($user_id) {
    //     $this->db->select('publication_id, COUNT(user_id) as total');
    //     $this->db->from('like_tbl');
    //     $this->db->group_by('publication_id');
    //     $this->db->where('user_id', $user_id);
    //     // $this->db->order_by('user_id', 'DESC');
    //     return $this->db->get();
    // }

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

    public function completed_count($id){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->where('submittor', $id);
        $this->db->where('publication_type', "Completed Research");
        return $this->db->get()->num_rows();
    }

    public function presented_count($id){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->where('submittor', $id);
        $this->db->where('publication_type', "Presented Research");
        return $this->db->get()->num_rows();
    }

    public function published_count($id){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->where('submittor', $id);
        $this->db->where('publication_type', "Published Research");
        return $this->db->get()->num_rows();
    }

    public function creative_count($id){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->where('submittor', $id);
        $this->db->where('publication_type', "Creative Works");
        return $this->db->get()->num_rows();
    }

    public function like($data){
        $this->db->insert('like_tbl', $data);
    }

    public function like_update($id){
        $this->db->set('like_counter', 'like_counter+1', FALSE);
        $this->db->where('publication_id', $id);
        $this->db->update('like_tbl');
    }

    public function like_check($data){
        $query = $this->db->get_where('like_tbl', $data);
        if ($query->num_rows() == 1) {
            return true;
        }else{
            return false;
        }
    }

    public function like_count($id){
        $this->db->select('*');
        $this->db->from('like_tbl');
        $this->db->where('publication_id', $id);
        return $this->db->get()->num_rows();
    }

    //NOTIF
    public function update_notif(){
        $this->db->where('status', 'Unread');
        $this->db->set('status', 'Read');
        $this->db->update('notification');
    }

    public function select_notif($submittor){
        $this->db->select('*');
        $this->db->from('notification');
        $this->db->join('user', 'user.user_id = notification.user_id', 'inner');
        $this->db->join('publication', 'publication.publication_id = notification.publication_id', 'inner');
        // $this->db->where('status', 'Unread');
        $this->db->where('submittor', $submittor);
        $this->db->limit(5);
        $this->db->order_by('notification_id', 'DESC');
        return $this->db->get();
    }

    function publication_review($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update('publication', $data);
    }

    public function count_notif($submittor){
        $this->db->select('*');
        $this->db->from('notification');
        $this->db->join('publication', 'publication.publication_id = notification.publication_id', 'inner');
        $this->db->where('notification.status', 'Unread');
        $this->db->where('submittor', $submittor);
        return $this->db->get();
    }

    function send_notif($data2){
        $this->db->insert('notification', $data2);
    }

    //SELECT RESEARCH DATA
    public function select_user($username){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        return $this->db->get()->result();
    }

    //RESEARCH_TABLE VIEW
    public function select_all_completed($user_id){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'user_id' => $user_id,
            'author_type' => 'Main'
        );
        $this->db->where($array);
        return $this->db->get()->result();
    }

    public function select_all_presented($user_id){
        $this->db->select('*');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'user_id' => $user_id,
            'author_type' => 'Main'
        );
        $this->db->where($array);
        return $this->db->get()->result();
    }

    public function select_all_published($user_id){
        $this->db->select('*');
        $this->db->from('published');
        $this->db->join('publication', 'publication.publication_id = published.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'user_id' => $user_id,
            'author_type' => 'Main'
        );
        $this->db->where($array);
        return $this->db->get()->result();
    }

    public function select_all_creative($user_id){
        $this->db->select('*');
        $this->db->from('creative_works');
        $this->db->join('publication', 'publication.publication_id = creative_works.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'user_id' => $user_id,
            'author_type' => 'Main'
        );
        $this->db->where($array);
        return $this->db->get()->result();
    }
    //END OF RESEARCH_TABLE VIEW

    public function fetch_all_authors(){
        $this->db->select('*');
        $this->db->from('author');
        return $this->db->get()->result();
    }

    public function fetch_all_editors(){
        $this->db->select('*');
        $this->db->from('editor');
        return $this->db->get()->result();
    }

    public function display_authors($publication_id){
        $this->db->select('*');
        $this->db->from('author');
        $this->db->where('publication_id', $publication_id);
        return $this->db->get()->result();
    }

    public function publication_delete($id){
        $this->db->where('publication_id', $id);
        $this->db->delete(array('completed', 'author', 'presented', 'creative_works', 'published', 'log', 'notification' ,'comment' , 'like_tbl', 'publication'));
    }

    //RECENT VIEW
    public function select_all_completed_recent(){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        $this->db->limit(2);
        return $this->db->get()->result();
    }

    public function select_all_presented_recent(){
        $this->db->select('*');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        $this->db->limit(2);
        return $this->db->get()->result();
    }

    public function select_all_published_recent(){
        $this->db->select('*');
        $this->db->from('published');
        $this->db->join('publication', 'publication.publication_id = published.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        $this->db->limit(2);
        return $this->db->get()->result();
    }

    public function select_all_creative_recent(){
        $this->db->select('*');
        $this->db->from('creative_works');
        $this->db->join('publication', 'publication.publication_id = creative_works.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        $this->db->limit(2);
        return $this->db->get()->result();
    }
    //END OF RECENT VIEW

    //display last 5 publications
    /*
    public function recent_pub(){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $array = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($array);
        $this->db->order_by('publication.publication_id', 'DESC');
        $this->db->limit(2);
        //order by publication_id desc and limit 5
        return $this->db->get()->result();
    }*/

    public function get_notifications($user_id){
        $this->db->select('*');
        $this->db->from('notification');
        $this->db->where('recepient', $user_id);
    }

    public function notification_insert($data){
        $this->db->insert('notification');
    }

    /*
    public function getDepartment(){
        $this->db->distinct();
        $this->db->group_by('department');
        $user = $this->db->get('user');
        if($user->num_rows() > 0){
            return $user->result();
        }
    }

    public function getType_Research(){
        $this->db->distinct();
        $this->db->group_by('publication_type');
        $type = $this->db->get('publication');
        if($type->num_rows() > 0){
            return $type->result();
        }
    }
    */
    //Fetch Search Filter Data
    public function search_filter_completed($department, $year, $type_of_research){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        /*
        $data = array(
            'status' => 'Approved',
            'department' => $department,
            'year' => $year,
            'publication_type' => $type_of_research
        );
        */
        $this->db->where('status', 'Approved');
        if($department != NULL){
        $this->db->where('department', $department);
        }
        if($year != NULL){
        $this->db->where('year', $year);
        }
        if($type_of_research != NULL){
        $this->db->where('publication_type', $type_of_research);
        }
        return $this->db->get()->result();
    }

    public function search_filter_presented($department, $year, $type_of_research){
        $this->db->select('*');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $data = array(
            'status' => 'Approved',
            'department' => $department,
            'date_presentation' => $year,
            'publication_type' => $type_of_research
        );
        $this->db->where('status', 'Approved');
        if($department != NULL){
        $this->db->where('department', $department);
        }
        if($year != NULL){
        $this->db->like('date_presentation', $year);
        }
        if($type_of_research != NULL){
        $this->db->where('publication_type', $type_of_research);
        }
        return $this->db->get()->result();
    }

    public function search_filter_published($department, $year, $type_of_research){
        $this->db->select('*');
        $this->db->from('published');
        $this->db->join('publication', 'publication.publication_id = published.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $data = array(
            'status' => 'Approved',
            'department' => $department,
            'year_published' => $year,
            'publication_type' => $type_of_research
        );
        $this->db->where('status', 'Approved');
        if($department != NULL){
        $this->db->where('department', $department);
        }
        if($year != NULL){
        $this->db->where('year_published', $year);
        }
        if($type_of_research != NULL){
        $this->db->where('publication_type', $type_of_research);
        }
        return $this->db->get()->result();
    }

    public function search_filter_creative($department, $year, $type_of_research){
        $this->db->select('*');
        $this->db->from('creative_works');
        $this->db->join('publication', 'publication.publication_id = creative_works.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $data = array(
            'status' => 'Approved',
            'department' => $department,
            'month_year' => $year,
            'publication_type' => $type_of_research
        );
        $this->db->where('status', 'Approved');
        if($department != NULL){
        $this->db->where('department', $department);
        }
        if($year != NULL){
        $this->db->where('month_year', $year);
        }
        if($type_of_research != NULL){
        $this->db->where('publication_type', $type_of_research);
        }
        return $this->db->get()->result();
    }
    //END OF FILTER SEARCH

    //Fetch Search Function Data
    public function search_completed($keyword){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'publication.publication_id = author.publication_id', 'inner');
        if($keyword != NULL){
            $this->db->like('title', $keyword);
            $this->db->or_like('year', $keyword);
            $this->db->or_like('institution', $keyword);
            $this->db->or_like('location', $keyword);
            $this->db->or_like('completed_type', $keyword);
            $this->db->or_like('author.first_name', $keyword);
            $this->db->or_like('author.last_name', $keyword);
        }
        $data = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($data);
        //$this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    public function search_presented($keyword){
        $this->db->select('*');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        if($keyword != NULL){
            $this->db->like('title_presented', $keyword);
            $this->db->or_like('date_presentation', $keyword);
            $this->db->or_like('title_conference', $keyword);
            $this->db->or_like('place_conference', $keyword);
            $this->db->or_like('presented_type', $keyword);
            $this->db->or_like('author.first_name', $keyword);
            $this->db->or_like('author.last_name', $keyword);
        }
        
        $data = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($data);
        //$this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    public function search_published($keyword){
        $this->db->select('*');
        $this->db->from('published');
        $this->db->join('publication', 'publication.publication_id = published.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        if($keyword != NULL){
            $this->db->like('year_published', $keyword);
            $this->db->or_like('title_article', $keyword);
            $this->db->or_like('title_journal', $keyword);
            $this->db->or_like('indexing_database', $keyword);
            $this->db->or_like('title_chapter', $keyword);
            $this->db->or_like('publisher', $keyword);
            $this->db->or_like('place_of_publication', $keyword);
            $this->db->or_like('place_of_conference', $keyword);
            $this->db->or_like('published_type', $keyword);
            $this->db->or_like('title_conference', $keyword);
            $this->db->or_like('author.first_name', $keyword);
            $this->db->or_like('author.last_name', $keyword);
        }
        $data = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($data);
        //$this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }

    public function search_creative($keyword){
        $this->db->select('*');
        $this->db->from('creative_works');
        $this->db->join('publication', 'publication.publication_id = creative_works.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        if($keyword != NULL){
            $this->db->like('type_cw', $keyword);
            $this->db->or_like('month_year', $keyword);
            $this->db->or_like('title_work', $keyword);
            $this->db->or_like('role', $keyword);
            $this->db->or_like('place_performance', $keyword);
            $this->db->or_like('publisher', $keyword);
            $this->db->or_like('artwork_exhibited', $keyword);
            $this->db->or_like('commission_agency', $keyword);
            $this->db->or_like('scope_audience', $keyword);
            $this->db->or_like('award_received', $keyword);
            $this->db->or_like('author.first_name', $keyword);
            $this->db->or_like('author.last_name', $keyword);
        }
        $data = array(
            'author_type' => 'Main',
            'status' => 'Approved'
        );
        $this->db->where($data);
        //$this->db->order_by('publication.publication_id', 'DESC');
        return $this->db->get()->result();
    }
    ///////////////////

    //RESEARCH_TABLE VIEW
    public function select_all_completed_view($publication_id){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $array = array(
            'publication.publication_id' => $publication_id,
            'author_type' => 'Main'
        );
        $this->db->where($array);
        return $this->db->get()->result();
    }

    public function select_all_presented_view($publication_id){
        $this->db->select('*');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $array = array(
            'publication.publication_id' => $publication_id,
            'author_type' => 'Main'
        );
        $this->db->where($array);
        return $this->db->get()->result();
    }

    public function select_all_published_view($publication_id){
        $this->db->select('*');
        $this->db->from('published');
        $this->db->join('publication', 'publication.publication_id = published.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $array = array(
            'publication.publication_id' => $publication_id,
            'author_type' => 'Main'
        );
        $this->db->where($array);
        return $this->db->get()->result();
    }

    public function select_all_creative_view($publication_id){
        $this->db->select('*');
        $this->db->from('creative_works');
        $this->db->join('publication', 'publication.publication_id = creative_works.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('user', 'user.user_id = author.user_id', 'inner');
        $array = array(
            'publication.publication_id' => $publication_id,
            'author_type' => 'Main'
        );
        $this->db->where($array);
        return $this->db->get()->result();
    }

    public function select_publication_type($publication_id){
        $this->db->select('publication_type');
        $this->db->from('publication');
        $this->db->where('publication_id', $publication_id);
        return $this->db->get()->row()->publication_type;
    }

    public function select_type_completed($publication_id){
        $this->db->select('completed_type');
        $this->db->from('completed');
        $this->db->where('publication_id', $publication_id);
        return $this->db->get()->row()->completed_type;    
    }
    

    //INSERT FUNCTIONS
    public function completed_insert($data){
        $this->db->insert("completed", $data);
    }

    public function presented_insert($data){
        $this->db->insert("presented", $data);
    }

    public function published_insert($data){
        $this->db->insert("published", $data);
    }

    public function creative_insert($data){
        $this->db->insert("creative_works", $data);
    }

    public function author_insert($data){
        $this->db->insert("author", $data);
    }

    public function publication_insert($data){
        $this->db->insert("publication", $data);
    }

    public function comment_insert($data){
        $this->db->insert("comment", $data);
    }

    public function editor_insert($data){
        $this->db->insert("editor", $data);
    }

    //UPDATE FUNCTIONS
    public function publication_update($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update("publication", $data);
    }

    public function completed_update($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update("completed", $data);
    }

    public function presented_update($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update("presented", $data);
    }

    public function published_update($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update("published", $data);
    }

    public function creative_update($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update("creative_works", $data);
    }

    public function getAuthor_id($publication_id){
        $this->db->select('*');
        $this->db->from('author');
        $this->db->where('publication_id', $publication_id);
        return $this->db->get()->result();
    }

    public function author_update($data, $id){  
        $this->db->where('author_id', $id);
        $this->db->update("author", $data);
    }

    public function getPublished_id($publication_id){
        $this->db->select('*');
        $this->db->from('published');
        $this->db->where('publication_id', $publication_id);
        return $this->db->get()->result();
    }

    public function getEditor_id($published_id){
        $this->db->select('*');
        $this->db->from('editor');
        $this->db->where('published_id', $published_id);
        return $this->db->get()->result();
    }

    public function editor_update($data, $id){
        $this->db->where('editor_id', $id);
        $this->db->update("editor", $data);
    }

    public function comment_display($id){
        $this->db->select('*');
        $this->db->from('comment');
        $this->db->join('user', 'user.user_id = comment.user_id', 'inner');
        $this->db->join('publication', 'publication.publication_id = comment.publication_id', 'inner');
        $this->db->where('publication.publication_id', $id);
        $this->db->order_by('comment_id', 'DESC');
        return $this->db->get()->result();
    }
}
?>