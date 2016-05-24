<?php
class Couchs_Model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function getCouchs(){
        	$query = $this->db->query('SELECT * FROM couch');
        	return $query->result();
        }
}