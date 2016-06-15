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
                return $query->result();
        }

        public function getTipoOfCouch($id_couch)
        {
                $query = $this->db->query('SELECT t.tipo, t.id_tipo FROM couch c inner join tipo_de_couch t WHERE c.id_tipo = ? ', array($id_couch));
                 return $query->result();
        }

        public function getUserData($id_usuario){
                $query = $this->db->query("SELECT tipo FROM usuario WHERE usuario.estado = 'normal' and usuario.id_usuario = ? ", array($id_usuario));
                return $query->result();
        }

         public function getUserNom($id_usuario){
                $query = $this->db->query("SELECT nombre FROM usuario WHERE usuario.estado = 'normal' and usuario.id_usuario = ? ", array($id_usuario));
                return $query->result();
        }

        public function getUserData2($id_usuario){
                $query = $this->db->query("SELECT u.nombre FROM usuario WHERE usuario.estado = 'normal' and usuario.id_usuario = ? ", array($id_usuario));
                return $query->result();
        }

        public function getId($email){
        $query = $this->db->query("SELECT id_usuario FROM usuario WHERE usuario.estado = 'normal' and usuario.email = ? ", array($email));
            return $query->result();
        }
}
