<?php
class Admin_Model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function getTiposDeHospedaje(){
        	$query = $this->db->query('SELECT * FROM tipo_de_couch');
        	return $query->result();
        }
        
        public function agregarTipoDeHospedaje($tipo){
        	$sentence = "INSERT INTO `couchInn`.`tipo_de_couch` (`id_tipo`, `tipo`) VALUES (NULL," . $tipo . " )";
        	$query = $this->db->query($sentence);
        	return $query->result();
        }
}