<?php
class Puntajes_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function agregarPuntaje($id_couch,$id_usuario,$puntaje,$comentario)
	{
		//Agrega un puntaje a un couch
		$sentence = "INSERT INTO  `couchInn`.`puntajes_couch` (
						`id_puntaje_couch` ,
						`id_couch` ,
						`id_usuario` ,
						`puntaje` ,
						`comentario`
						)
						VALUES ( NULL , ? , ? , ? , ?);";
		$query = $this->db->query($sentence,array($id_couch,$id_usuario,$puntaje,$comentario));
	}

	public function agregarPuntajeAUsuario($id_usuario,$id_usuario_puntuado,$puntaje,$comentario)
	{
		//Agrega un puntaje a un usuario
		$sentence = "INSERT INTO  `couchInn`.`puntajes_usuario` (
						`id_puntaje_usuario` ,
						`id_usuario` ,
						`id_usuario_puntuado` ,
						`puntaje` ,
						`comentario`
						)
						VALUES (NULL ,  ?,  ?,  ?,  ?);";
		$query = $this->db->query($sentence,array($id_usuario,$id_usuario_puntuado,$puntaje,$comentario));
	}

	public function getPuntajesCouchs()
	{
		//Retorna todos los puntajes a los couchs
		$sentence = "SELECT * FROM puntajes_couch;";
		$query = $this->db->query($sentence);
		return $query->result();
	}

	public function getPuntajesUsuario()
	{
		//Retorna todos los puntajes a los couchs
		$sentence = "SELECT * FROM puntajes_usuario;";
		$query = $this->db->query($sentence);
		return $query->result();
	}

	public function getPuntajesDeCouch($id_couch)
	{
		$sentence = "SELECT * FROM puntajes_couch p WHERE p.id_couch = ?;";
		$query = $this->db->query($sentence,array($id_couch));
		return $query->result();
	}

	public function getPuntajePromedioCouch($id_couch)
	{
		$sentence = "SELECT avg(p.puntaje) as promedio FROM puntajes_couch p WHERE p.id_couch = ?;";
		$query = $this->db->query($sentence,array($id_couch));
		return $query->result();
	}
}