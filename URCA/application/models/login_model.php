<?php

Class login_model extends CI_Model {

     // Query to insert data in database
    public function user_insert($data) { 
        $this->db->insert('user', $data);
    }

    public function user_login($data){
        $query = $this->db->get_where('user', $data);
        if ($query->num_rows() == 1) {
            return true;
        }else{
            return false;
        }
    }

    public function user_session($username){
        $query = $this->db->get_where('user', array('username'=>$username));
        if ($query->num_rows() == 1) {
            return $query->result();
        }else{
            return false;
        }
    }

    public function researcher_insert($data2){
        $this->db->insert('researcher', $data2);
    }

    public function admin_insert($data3){
        $this->db->insert('admin', $data3);
    }

}

?>
