<?php
class Sesiones_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	//Usado en:
	public function getUser($email){
		$sentence = "SELECT * FROM usuario u WHERE u.email = ? and u.estado = 'normal' ";
		$query = $this->db->query($sentence,array($email));
		return $query->result();
	}

	//Usado en:
	public function getUserWithPass($email,$passw){
		$sentence = "SELECT * FROM usuario u WHERE u.email = ? and u.passw = ? and u.estado = 'normal'";
		$query = $this->db->query($sentence,array($email,$passw));
		return $query->result();
	}

	//Usado en:
	public function getPassw($email){       
		$sentence = "SELECT u.passw FROM usuario u WHERE u.email = ? and u.estado = 'normal' ";
		$query = $this->db->query($sentence, array($email));
	}

	//Usado en:
	public function eliminarUsuario($email)
	{
		$sentece = "UPDATE  `couchInn`.`usuario` SET  `estado` =  'borrado' WHERE  `usuario`.`email` = ? ;";
		$query = $this->db->query($sentence,array($email));
	}

	//Usado en:
	public function recuperarUsuario($email)
	{
		$sentece = "UPDATE  `couchInn`.`usuario` SET  `estado` =  'normal' WHERE  `usuario`.`email` = ? ;";
		$query = $this->db->query($sentence,array($email));		
	}

	//Usado en:
	public function agregarUsuario($arrayDatos)
	{	
		if (empty($this->getUser($arrayDatos['email']))) {
			$sentence = "INSERT INTO  `couchInn`.`usuario` (
								`id_usuario` ,
								`nombre` ,
								`apellido` ,
								`email` ,
								`passw` ,
								`telefono` ,
								`fecha_nacimiento` ,
								`tipo` ,
								`estado`
								)
								VALUES (
								NULL ,?,?,?,?,?,?,?,'normal'
								);";
				$query = $this->db->query($sentence,$arrayDatos);
			}
	}

	//Usado en:
	public function modificarUsuario($usuario)
	{
		$email = $usuario['email'];
		if(!empty($usuario['nombre'])) $this->setNombre($usuario['nombre'],$email);
		if(!empty($usuario['apellido'])) $this->setApellido($usuario['apellido'],$email);
		if(!empty($usuario['passw'])) $this->setContrasenia($usuario['passw'],$email);
		if(!empty($usuario['telefono'])) $this->setTelefono($usuario['telefono'],$email);
		if(!empty($usuario['fecha_nacimiento'])) $this->setFechaDeNacimiento($usuario['fecha_nacimiento'],$email);

	}

	//Usado en:
	public function makeUserPremium($email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `tipo` =  'premium' WHERE  `usuario`.`email` = ? and `usuario`.estado = 'normal';";
		$query = $this->db->query($sentence,array($email));	
	}

	//Usado en:
	public function setNombre($nombre,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `nombre` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($nombre,$email));
	}

	//Usado en:
	public function setApellido($apellido,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `apellido` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($apellido,$email));
	}

	//Usado en:
	public function setContrasenia($passw,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `passw` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($passw,$email));
	}

	//Usado en:
	public function setTelefono($telefono,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `telefono` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($telefono,$email));
	}

	//Usado en:
	public function setFechaDeNacimiento($fecha_nacimiento,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `fecha_nacimiento` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($fecha_nacimiento,$email));
	}

	//Usado en: inicio(view)
	public function getUserById($id_usuario){
		$query = $this->db->query("SELECT * FROM usuario WHERE usuario.estado = 'normal' and usuario.id_usuario = ? ", array($id_usuario));
        return $query->result();
	}
	//Usado en: verImagenes,
	public function getUserByEmail($email){ 
		$query = $this->db->query("SELECT * FROM usuario WHERE usuario.estado = 'normal' and usuario.email = ? ", array($email));
        	return $query->result();
		}
	//usado en:
	public function getCantDeMensajesSinR($id_couchUserLog){ // retonrna la cantidad de mensajes sin lee del user logeado
		$query = $this->db->query("SELECT count(*) FROM comentarios WHERE comentarios.id_couch = ? and comentarios.respuesta = ''", array($id_couchUserLog));
		return $query->result();

	}
	//usado en: Descripcion
	public function getId($email){
		$query = $this->db->query("SELECT id_usuario FROM usuario WHERE usuario.estado = 'normal' and usuario.email = ? ", array($email));
		return $query->result();
	}
}