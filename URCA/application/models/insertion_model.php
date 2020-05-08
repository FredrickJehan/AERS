<?php
class Insertion_Model extends CI_Model{
    #function savethesis($thesisAuthor, $thesisYear, $thesisTitle, $thesisInstitute, $thesisURL){
    #    $query="INSERT INTO thesis VALUES('', '$thesisAuthor', '$thesisYear', '$thesisTitle', '$thesisInstitute', '$thesisURL')";
    #    $this->db->query($query);
    #}

    function insert_data($data){
        //inserts data array into table

        $this->db->insert("completed_research", $data);
    }
    function insert_presented_data($data){
        $this->db->insert("presented", $data);
    }

    function insert_journal_article_data($data){
        $this->db->insert("journal_article", $data);
    }

    function insert_book_textbook_data($data){
        $this->db->insert("book_textbook", $data);
    }

    function insert_book_chapter_data($data){
        $this->db->insert("book_chapter", $data);
    }

    function insert_conference_proceedings_data($data){
        $this->db->insert("conference_proceedings", $data);
    }

    function insert_creative_work_data($data){
        $this->db->insert("creative_work", $data);
    }

    function fetch_comp_data($user_id){
        //select * from thesis
        $query = $this->db->get_where("completed_research", array('user_id'=> $user_id));
        return $query;
    }

    function fetch_presented_data($user_id){
        $query = $this->db->get_where("presented", array('user_id'=> $user_id));
        return $query;
    }

    function fetch_comp_data_all(){
        //select * from thesis
        $query = $this->db->get_where("completed_research");
        return $query;
    }

    function fetch_presented_data_all(){
        $query = $this->db->get_where("presented");
        return $query;
    }

    //deletes id in table thesis
    function delete_data($id){
        $this->db->where("cr_id", $id);
        $this->db->delete("completed_research");
    }

    function delete_presented_data($id){
        $this->db->where("pd_id", $id);
        $this->db->delete("presented");
    }

    //
    function fetch_single_data($id){
        $this->db->where("cr_id", $id);
        $query = $this->db->get("thesis");
        return $query;
    }

    function get_research_detail($id){
        //$query = $this->db->get_where('completed_research', ['cr_id' => $id])->row();
        //$query = $this->db->query("SELECT * FROM 'completed_research' WHERE cr_id = $id");
        //$query = $this->db->get_where('completed_research', array('cr_id' => $id));
        //return $query;
        
        $this->db->where("cr_id", $id);
        $query = $this->db->get("completed_research");
        return $query->result();
    }

    function getList(){
        return $this->db->get('completed_research')->result();
    }
    
    //update fetch model
    function update_researchCR($id, $data){
        $this->db->where('cr_id', $id);
        $this->db->update('completed_research', $data);
    }

    function update_researchPD($id, $data){
        $this->db->where('pd_id', $id);
        $this->db->update('presented', $data);
    }

    function update_researchJA($id, $data){
        $this->db->where('ja_id', $id);
        $this->db->update('journal_article', $data);
    }

    function update_researchBT($id, $data){
        $this->db->where('bk_id', $id);
        $this->db->update('book_textbook', $data);
    }

    function update_researchBC($id, $data){
        $this->db->where('bc_id', $id);
        $this->db->update('book_chapter', $data);
    }

    function update_researchCP($id, $data){
        $this->db->where('cp_id', $id);
        $this->db->update('conference_proceedings', $data);
    }

    function update_researchCW($id, $data){
        $this->db->where('cw_id', $id);
        $this->db->update('creative_work', $data);
    }

    //export fetch model
    function fetch_data(){
        $this->db->order_by("cr_id", "DESC");
        $query = $this->db->get("completed_research");
        return $query->result();
}
    
}
?>