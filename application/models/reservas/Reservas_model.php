<?php
class Reservas_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getReservasDeCouch($id_couch)
	{
		$sentence = "	SELECT r.id_reserva,r.fecha_inicio,r.fecha_fin,r.estado,u.email,u.nombre,u.id_usuario
						FROM reserva r 	inner join couch c on (r.id_couch = c.id_couch)
										inner join usuario u on (r.id_usuario = u.id_usuario)
					 	WHERE c.id_couch = r.id_couch
					 	ORDER BY r.estado;";
		$query = $this->db->query($sentence);
		return $query->result();
	}

	public function getReservasAceptadasDeCouch($id_couch)
	{
		//Usado en ReservarCouch
		$sentence = "SELECT * FROM reserva r inner join couch c on r.id_couch = c.id_couch WHERE r.estado = 'aceptada' and '".$id_couch."' = r.id_couch ORDER BY r.fecha_inicio";
		$query = $this->db->query($sentence);
		return $query->result();
	}

	public function getReservasDeCouchsDeUsuario($id_usuario)
	{
		//No se si hace falta, lo dejo por las dudas
		//Trae todas las reservas de todos los couchs pertenecientes a un usuario
		$sentence = "	SELECT * 
						FROM reserva r
						WHERE r.id_couch IN
						(SELECT * FROM couch c  WHERE c.estado = 'normal' and c.id_usuario = ?) ";
		
		$query = $this->db->query($sentence,array($id_usuario));
		return $query->result();
	}

	public function getReservasAceptadasEntre2FechasParaCouch($fecha_inicio,$fecha_fin,$id_couch)
	{
		//Usado en ReservarCouch
		$sentence = "	SELECT 	*
						FROM	reserva r
						WHERE 	(r.id_couch = '".$id_couch."') and (r.estado = 'aceptada') and
								((r.fecha_fin between '".$fecha_inicio."' and '".$fecha_fin."') or
      							(r.fecha_inicio between '".$fecha_inicio."' AND '".$fecha_fin."'));";

      	$query = $this->db->query($sentence);
      	return $query->result();
	}

	public function agregarReserva($datos)
	{
		$sentence = "INSERT INTO `couchInn`.`reserva` 
					(`id_reserva`, `id_couch`, `id_usuario`, `fecha_inicio`, `fecha_fin`, `estado`) 
					VALUES (NULL, ?, ?, ?, ?, 'pendiente');";

		$query = $this->db->query($sentence,$datos);
	}

	public function aceptarReserva($id_reserva)
	{
		$sentence = "UPDATE  `couchInn`.`reserva` SET  `estado` =  'aceptada' WHERE  `reserva`.`id_reserva` = ? ;";
		$query = $this->db->query($sentence, array($id_reserva));
	}

	public function rechazarReserva($id_reserva)
	{
		$sentence = "UPDATE  `couchInn`.`reserva` SET  `estado` =  'rechazada' WHERE  `reserva`.`id_reserva` = ? ;";
		$query = $this->db->query($sentence, array($id_reserva));
	}

	public function actualizarReservasVencidas()
	{
		//Hace que todas las reservas cuya fecha fin ya pasó y fueron aceptadas pasen a estar vencidas
		//Usada en IniciarSesion

		$sentence = "UPDATE  `couchInn`.`reserva` SET  `estado` =  'vencida' WHERE  reserva.estado = 'aceptada' and `reserva`.`fecha_fin` <= NOW() ;";
		$query = $this->db->query($sentence);
	}

	public function rechazarReservasCuyoTiempoExpiro()
	{
		//Hace que se pongan en rechazadas las reservas pendientes cuya fecha fin ya pasó
		//Usada en IniciarSesion

		$sentence = "UPDATE  `couchInn`.`reserva` SET  `estado` =  'rechazada' WHERE  reserva.estado = 'pendiente' and `reserva`.`fecha_fin` <= NOW() ;";
		$query = $this->db->query($sentence);
	}

	public function getReservasDeUsuario($id_usuario)
	{
		//Trae las reservas realizadas por un usuario, todas
		//Usada en VerMisReservas

		$sentence = "	SELECT r.id_reserva,r.fecha_inicio,r.fecha_fin,c.id_couch,c.titulo,r.estado,r.id_usuario
						FROM reserva r inner join couch c on r.id_couch = c.id_couch 
						WHERE r.id_usuario = ? 
						ORDER BY c.id_couch";

		$query = $this->db->query($sentence, array($id_usuario));
		return $query->result();
	}
}