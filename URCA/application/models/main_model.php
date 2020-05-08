<?php
	class main_model extends CI_Model{
		function __construct()
		{
			parent::__construct();
			$this->load->database();//loading database
		}
		function add_record($values)//adding values into employee table
		{
			$result=$this->db->insert('thesis',$values);
			return($result);
		}
		function display_all()//function to display all records
		{
			$query=$this->db->get('thesis');
			return($query->result());
		}
	}
?>
