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
    
    public function fetch_json_completed(){
        $this->db->select('*');
        $this->db->from('completed AS c');
        $this->db->join('publication AS p', 'p.publication_id = c.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id');
        $this->db->join('user AS u', 'u.user_id = a.user_id');
        $this->db->order_by('p.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_presented(){
        $this->db->select('*');
        $this->db->from('presented AS pr');
        $this->db->join('publication AS p', 'p.publication_id = pr.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id');
        $this->db->join('user AS u', 'u.user_id = a.user_id');
        $this->db->order_by('p.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_published(){
        $this->db->select('*');
        $this->db->from('published AS pp');
        $this->db->join('publication AS p', 'p.publication_id = pp.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id');
        $this->db->join('user AS u', 'u.user_id = a.user_id');
        $this->db->order_by('p.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_json_creative(){
        $this->db->select('*');
        $this->db->from('creative_works AS c');
        $this->db->join('publication AS p', 'p.publication_id = c.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id');
        $this->db->join('user AS u', 'u.user_id = a.user_id');
        $this->db->order_by('p.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }
    
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

    public function import_published($user_array, $author_array, $publication_array, $array){
        $user_query = $this->import_user_check($user_array);
        //$author_query = $this->import_author_check($author_array);
        $publication_query = $this->import_publication_check($publication_array);
        //$published_query = $this->import_published_check($array);
        if(count($user_query) == 0){
            $this->db->insert('user', $user_array);
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('published', $array);
        }elseif(count($publication_query) == 0){
            $this->db->insert('publication', $publication_array);
            $this->db->insert('author', $author_array);
            $this->db->insert('published', $array);
        }else{
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

    public function fetch_all_authors_admin(){
        $this->db->select('*');
        $this->db->from('author');
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
        $output ='
            <table width="100%" cellspacing="5" cellpadding="5">
        ';
        $output .='
        <tr>
            <p><b><th width="20%">Author</th></b></p>
            <p><b><th width="20%">Department</th></b></p> 
            <p><b><th width="5%">Number of Views</th></b></p>
            <p><b><th width="10%">Type of Research</th></b></p>
            <p><b><th width="45%">Citation</th></b></p>
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
                        <td width="5%"><center>'.$row->num_views.'</center></td>
                        <td width="10%">'.$row->publication_type.'</td>
                    ';
        if(!empty($row->url)){
        $output .='    
                    <td width="45%">
                    '.implode(', ', $string).'('.$row->year.').
                    <i>'.$row->title.'</i>. '.$row->location.': '.$row->institution.'. Retrieved from '.$row->url.'
                    </td>
            ';    
        }else{
        $output .='
                    <td width="45%">
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
                $output .='
                <tr>
                    <td width="20%">'.implode(', ', $string).'</td>
                    <td width="20%">'.$row->department.'</td>
                    <td width="5%"><center>'.$row->num_views.'</center></td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="45%">
                        '.implode(', ', $string).'('.$row->date_presentation.'). 
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
                $output .='
                <tr>
                    <td width="20%">'.implode(', ', $string).'</td>
                    <td width="20%">'.$row->department.'</td>
                    <td width="5%"><center>'.$row->num_views.'</center></td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="45%">
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
                        '.implode(', ', $string).'('.$row->year_published.'). '.$row->title_chapter.'. 
                        <i>'.$row->title_book.'</i>('.$row->page_num.'). '.$row->place_of_publication.':'.$row->publisher.'.'; 
                $output .='
                    </td>
                </tr>
                ';
                }else{
                $output .='
                    '.implode(', ', $string).'('.$row->year_published.'). '.$row->title_chapter.'. 
                    <i>'.$row->title_book.'</i>('.$row->page_num.'). '.$row->place_of_publication.':'.$row->publisher.''; 
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
                    <td width="5%"><center>'.$row->num_views.'</center></td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="45%">
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