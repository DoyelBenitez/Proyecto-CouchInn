<?php
class Sesiones_Model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function getUser($email){
        	$sentence = 'SELECT * FROM usuario u WHERE u.email = ? ';
        	$query = $this->db->query($sentence,array($email));
        	return $query->result();
        }

        public function getUserWithPass($email,$passw){
        	$sentence = 'SELECT * FROM usuario u WHERE u.email = ? and u.passw = ? ';
        	$query = $this->db->query($sentence,array($email,$passw));
        	return $query->result();
        }

        public function agregarUsuario($arrayDatos)
        {	
        	if (!empty(getUser($arrayDatos->email))) {
		        $sentence = "INSERT INTO  `couchInn`.`usuario` (
								`id_usuario` ,
								`nombre` ,
								`apellido` ,
								`email` ,
								`passw` ,
								`telefono` ,
								`fecha_nacimiento` ,
								`tipo`
								)
								VALUES (
								NULL ,?,?,?,?,?,?,?
								);";
				$query = $this->db->query($sentence,$arrayDatos);
			}
		}
		
}