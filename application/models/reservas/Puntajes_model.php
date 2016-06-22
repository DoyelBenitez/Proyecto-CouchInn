<?php
class Puntajes_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function agregarPuntaje($id_couch,$id_usuario,$puntaje)
	{
		$sentence = "INSERT INTO  `couchInn`.`puntajes_couch` (
						`id_puntaje_couch` ,
						`id_couch` ,
						`id_usuario` ,
						`puntaje`
						)
						VALUES ( NULL , ? , ? , ? );";
		$query = $this->db->query($sentence,array($id_couch,$id_usuario,$puntaje));
	}

	public function getPuntajesCouchs()
	{
		//Retorna todos los puntajes a los couchs
		$sentence = "SELECT * FROM puntajes_couch;";
		$query = $this->db->query($sentence);
		return $query->result();
	}

	public function getPuntajesDeCouch($id_couch)
	{
		$sentence = "SELECT * FROM puntajes_couch p WHERE p.id_couch = ?;";
		$query = $this->db->query($sentence,array($id_couch));
		return $query->result();
	}
}