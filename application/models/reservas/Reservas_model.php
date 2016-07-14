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
						WHERE c.id_couch = ?
						ORDER BY r.estado;";
		$query = $this->db->query($sentence,array($id_couch));
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

	public function getReservasVencidasDeUsuario($id_usuario)
	{
		$sentence = "	SELECT r.*,c.titulo
						FROM reserva r inner join couch c on r.id_couch = c.id_couch
						WHERE r.id_usuario = ? and r.estado = 'vencida';";
		
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

	////////Aceptar Reserva/////////////////////
	public function aceptarReserva($id_reserva)
	{
		$this->agregarRegistroDeAceptarReserva($id_reserva);
		$sentence = "UPDATE  `couchInn`.`reserva` SET  `estado` =  'aceptada' WHERE  `reserva`.`id_reserva` = ? ;";
		$query = $this->db->query($sentence, array($id_reserva));
	}

	public function agregarRegistroDeAceptarReserva($id_reserva)
	{
		$sentence = "INSERT INTO  reservas_aceptadas (
							`id_reserva_aceptada` ,
							`id_reserva` ,
							`fecha`)
					VALUES (NULL ,?,?);";
		$query = $this->db->query($sentence, array($id_reserva,date("Y-m-d")));
	}
	////////////////////////////////////////////

	//Usado en solicitudes aceptadas
	public function getReservasAceptadasEntre2Fechas($fecha_inicio,$fecha_fin)
	{
		$sentence ="SELECT r.*,u.email,c.titulo
					FROM reservas_aceptadas r
							inner join reserva re on r.id_reserva = re.id_reserva
							inner join usuario u on re.id_usuario = u.id_usuario
							inner join couch c on re.id_couch = c.id_couch
					WHERE r.fecha between ? and ?
					ORDER BY c.titulo";
		$query = $this->db->query($sentence, array($fecha_inicio,$fecha_fin));
		return $query->result();
	}

	public function rechazarReserva($id_reserva)
	{
		$sentence = "UPDATE  `couchInn`.`reserva` SET  `estado` =  'rechazada' WHERE  `reserva`.`id_reserva` = ? ;";
		$query = $this->db->query($sentence, array($id_reserva));
	}

	public function cancelarReserva($id_reserva)
	{
		$sentence = "UPDATE  `couchInn`.`reserva` SET  `estado` =  'cancelada' WHERE  `reserva`.`id_reserva` = ? ;";
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

	//Usado en busqueda
	public function getCouchConDisponibilidadEn($fecha_inicio,$fecha_fin)
	{
		$sentence ="SELECT co.*
					FROM couch co
					WHERE co.id_couch not in
					(	SELECT 	r.id_couch
						FROM	reserva r
						WHERE 	(r.estado = 'aceptada') and not
								((r.fecha_fin between ? and ?) or
								(r.fecha_inicio between ? and ?));";

		$query = $this->db->query($sentence, array($fecha_inicio,$fecha_fin,$fecha_inicio,$fecha_fin));
		return $query->result();
	}
}