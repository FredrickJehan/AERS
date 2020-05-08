<?php
class research_model extends CI_Model{

    public function select_researcher_id($username){
        //inner w/o null, outer wilth null, left outer , right outer
        $this->db->select('researcher.researcher_id');
        $this->db->from('researcher');
        $this->db->join('user', 'user.user_id = researcher.user_id', 'inner');
        $this->db->where('username', $username);
        return $this->db->get()->row()->researcher_id;
    }

    public function select_all_completed($researcher_id){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->where('researcher_id', $researcher_id);
        return $this->db->get()->result();
    }

    public function select_all_completed_view($publication_id){
        $this->db->select('*');
        $this->db->from('completed');
        $this->db->join('publication', 'publication.publication_id = completed.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('log', 'log.publication_id = publication.publication_id', 'inner');
        $this->db->join('researcher', 'researcher.researcher_id = author.researcher_id', 'inner');
        $this->db->join('user', 'user.user_id = researcher.user_id', 'inner');
        $this->db->where('publication.publication_id', $publication_id);
        return $this->db->get()->result();
    }

    public function select_all_presented_view($publication_id){
        $this->db->select('*');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->join('log', 'log.publication_id = publication.publication_id', 'inner');
        $this->db->join('researcher', 'researcher.researcher_id = author.researcher_id', 'inner');
        $this->db->join('user', 'user.user_id = researcher.user_id', 'inner');
        $this->db->where('publication.publication_id', $publication_id);
        return $this->db->get()->result();
    }

    public function select_all_presented($researcher_id){
        $this->db->select('*');
        $this->db->from('presented');
        $this->db->join('publication', 'publication.publication_id = presented.publication_id', 'inner');
        $this->db->join('author', 'author.publication_id = publication.publication_id', 'inner');
        $this->db->where('researcher_id', $researcher_id);
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

    public function select_all_creative_work($publication_id){
       
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

    public function publication_update($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update("publication", $data);
    }

    public function completed_update($data, $id){
        $this->db->where('publication_id', $id);
        $this->db->update("completed", $data);
    }

    public function author_update($data, $id){  
        $this->db->where('publication_id', $id);
        $this->db->update("author", $data);
    }
    
    public function completed_insert($data){
        $this->db->insert("completed", $data);
    }

    public function comment_insert($data){
        $this->db->insert("comment", $data);
    }

    public function comment_display($id){
        $this->db->select('*');
        $this->db->from('comment');
        $this->db->join('user', 'user.user_id = comment.user_id', 'inner');
        $this->db->join('publication', 'publication.publication_id = comment.publication_id', 'inner');
        $this->db->where('publication.publication_id', $id);
        return $this->db->get()->result();
    }

    public function presented_insert($data){
        $this->db->insert("presented", $data);
    }

    public function author_insert($data){
        $this->db->insert("author", $data);
    }

    public function publication_insert($data){
        $this->db->insert("publication", $data);
    }  

    public function publication_delete($id){
        $this->db->where('publication_id', $id);
        $this->db->delete(array('completed','author', 'presented', 'log', 'publication', 'comment'));

// $this->db->query("SET @num := 0;");
// $this->db->query("UPDATE your_table SET id = @num := (@num+1);");
// $this->db->query("ALTER TABLE tableName AUTO_INCREMENT = 1;");
    }
    
}
?>