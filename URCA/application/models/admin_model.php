<?php
class admin_model extends CI_Model{

    function publication_select_unapproved(){
        $this->db->select('*');
        $this->db->from('publication');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->where('status', '0');
        return $this->db->get()->result();
    }

    public function select_admin_id($username){
        //inner w/o null, outer wilth null, left outer , right outer
        $this->db->select('admin_id');
        $this->db->from('admin');
        $this->db->join('user', 'user.user_id = admin.user_id', 'inner');
        $this->db->where('username', $username);
        return $this->db->get()->row()->admin_id;
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
    public function fetch_pdf_completed(){
        $this->db->select('*');
        $this->db->from('completed AS c');
        $this->db->join('publication AS p', 'p.publication_id = c.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id');
        $this->db->join('researcher AS r', 'r.researcher_id = a.researcher_id');
        $this->db->order_by('p.publication_id', 'ASC');
        return $this->db->get();
    }

    public function fetch_json_completed(){
        $this->db->select('*');
        $this->db->from('completed AS c');
        $this->db->join('publication AS p', 'p.publication_id = c.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id');
        $this->db->join('researcher AS r', 'r.researcher_id = a.researcher_id');
        $this->db->order_by('p.publication_id', 'ASC');
        $query = $this->db->get();
        return json_encode($query->result(), JSON_PRETTY_PRINT);
    }

    public function fetch_pdf_presented(){
        $this->db->select('*');
        $this->db->from('presented AS pr');
        $this->db->join('publication AS p', 'p.publication_id = pr.publication_id');
        $this->db->join('author AS a', 'a.publication_id = p.publication_id');
        $this->db->join('researcher AS r', 'r.researcher_id = a.researcher_id');
        $this->db->order_by('p.publication_id', 'ASC');
        return $this->db->get();
    }

    public function fetch_download_pdf(){
        $comp = $this->fetch_pdf_completed();
        $pre = $this->fetch_pdf_presented();
        $output ='
            <table width="100%" cellspacing="5" cellpadding="5">
        ';
        $output .='
        <tr>
            <p><b><th width="20%">Name</th></b></p>
            <p><b><th width="20%">Department</th></b></p> 
            <p><b><th width="10%">Number of Views</th></b></p>
            <p><b><th width="10%">Type of Research</th></b></p>
            <p><b><th width="40%">Citation</th></b></p>
        </tr>
        ';
        if(!empty($comp) || !empty($pre)){
            foreach($comp->result() as $row){
        $output .='
        <tr>
            <td width="20%">'.$row->last_name.', '.$row->first_name.' '.$row->middle_initial.'</td>
            <td width="20%">'.$row->department.'</td>
            <td width="10%">'.$row->num_views.'</td>
            <td width="10%">'.$row->publication_type.'</td>
        ';if(!empty($row->url)){
        $output .='    
                    <td width="40%">
                    '.$row->last_name.', '.substr($row->first_name, 0, 1).'. '.$row->middle_initial.'('.$row->year.'). 
                    <i>'.$row->title.'</i>. '.$row->location.': '.$row->institution.'. Retrieved from '.$row->url.'
                    </td>
            ';    
        }else{
        $output .='
                    <td width="40%">
                    '.$row->last_name.', '.substr($row->first_name, 0, 1).'. '.$row->middle_initial.'('.$row->year.'). 
                    <i>'.$row->title.'</i>. '.$row->location.': '.$row->institution.'.
                    </td>
                ';
        }
        $output .='
        </tr>
        ';
            }
            foreach($pre->result() as $row){
                $output .='
                <tr>
                    <td width="20%">'.$row->last_name.', '.$row->first_name.' '.$row->middle_initial.'</td>
                    <td width="20%">'.$row->department.'</td>
                    <td width="10%">'.$row->num_views.'</td>
                    <td width="10%">'.$row->publication_type.'</td>
                    <td width="40%">
                        '.$row->last_name.', '.substr($row->first_name, 0, 1).'. '.$row->middle_initial.'('.$row->date_presentation.'). 
                        <i>'.$row->title_presented.'</i>. '.$row->title_conference.': '.$row->place_conference.'.
                    </td>
                </tr>    
                ';    
            }
        }   
        $output .='
            </table>
        ';
        return $output;
    }
}
?>