<?php
class Reservas_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getReservasDeCouch($id_couch)
	{
		$sentence = "SELECT * FROM reserva r inner join couch c on r.id_couch = c.id_couch WHERE c.id_couch = r.id_couch;";
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
}