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

	public function makeUserPremium($email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `tipo` =  'premium' WHERE  `usuario`.`email` = ? ;";
		$query = $this->db->query($sentence,array($email));	
	}

	public function getPassw($email)
	{       
		$sentence = 'SELECT u.passw FROM usuario u WHERE u.email = ? ';
		$query = $this->db->query($sentence, array($email));
	}

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
								`tipo`
								)
								VALUES (
								NULL ,?,?,?,?,?,?,?
								);";
				$query = $this->db->query($sentence,$arrayDatos);
			}
	}

	public function modificarUsuario($usuario)
	{
		$email = $usuario['email'];
		if(!empty($usuario['nombre'])) $this->setNombre($usuario['nombre'],$email);
		if(!empty($usuario['apellido'])) $this->setApellido($usuario['apellido'],$email);
		if(!empty($usuario['passw'])) $this->setContrasenia($usuario['passw'],$email);
		if(!empty($usuario['telefono'])) $this->setTelefono($usuario['telefono'],$email);
		if(!empty($usuario['fecha_nacimiento'])) $this->setFechaDeNacimiento($usuario['fecha_nacimiento'],$email);

	}

	public function setNombre($nombre,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `nombre` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($nombre,$email));
	}

	public function setApellido($apellido,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `apellido` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($apellido,$email));
	}

	public function setContrasenia($passw,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `passw` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($passw,$email));
	}

	public function setTelefono($telefono,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `telefono` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($telefono,$email));
	}

	public function setFechaDeNacimiento($fecha_nacimiento,$email)
	{
		$sentence = "UPDATE  `couchInn`.`usuario` SET  `fecha_nacimiento` =  ? WHERE  `usuario`.`email` = ?;";
		$query = $this->db->query($sentence,array($fecha_nacimiento,$email));
	}
		
}