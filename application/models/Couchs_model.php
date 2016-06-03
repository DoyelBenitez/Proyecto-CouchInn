<?php
class Couchs_Model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function getCouchs(){
        	$query = $this->db->query("SELECT * FROM couch WHERE couch.estado = 'normal';");
        	return $query->result();
        }

        public function getCouch($id_couch){ //Funcion que se usa para la descripcion de un couch
        	$query = $this->db->query("SELECT * FROM couch WHERE couch.estado = 'normal' and couch.id_couch = ? ", array($id_couch));
        	return $query->result();
        }

        public function getCouchImagenes($id_couch){ 
                $query = $this->db->query('SELECT * FROM imagenes_couchs WHERE imagenes_couchs.id_couch = ? ', array($id_couch));
                return $query->result();
        }

        public function getUserOfCouch($id_couch)
        {
                $query = $this->db->query('SELECT u.name FROM couch c inner join usuario u WHERE c.id_couch = ? ', array($id_couch));
        }

        public function getTipoOfCouch($id_couch)
        {
                $query = $this->db->query('SELECT t.tipo FROM couch c inner join tipo_de_couch t WHERE c.id_couch = ? ', array($id_couch));
        }
}
