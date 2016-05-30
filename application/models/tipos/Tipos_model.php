<?php
class Tipos_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}


	public function getTiposDeHospedaje(){
            $query = $this->db->query('SELECT * FROM tipo_de_couch');
            return $query->result();
      }

      public function existeTipo($idTipo)
      {
            $sentence = "SELECT t.tipo FROM tipo_de_couch t WHERE t.id_tipo = ?";
            $query = $this->db->query($sentence,array($idTipo));
            return $query->result();
      }

      public function existeNombreTipo($idTipo)
      {
            $sentence = "SELECT t.tipo FROM tipo_de_couch t WHERE t.tipo = ?";
            $query = $this->db->query($sentence,array($idTipo));
            return $query->result();
      }


	public function agregarTipoDeHospedaje($tipo)
	{
		if (empty($this->existeNombreTipo($tipo))) {
				$sentence = "INSERT INTO `couchInn`.`tipo_de_couch` (`id_tipo`, `tipo`) VALUES (NULL, ? )";
				$query = $this->db->query($sentence,array($tipo));
		}
		else{
			return NULL; 
		    }
	}

	public function eliminarTipoDeHospedaje($idTipo)
      {
            if (!empty($this->existeTipo($idTipo))) {
                  $sentence = "DELETE FROM `couchInn`.`tipo_de_couch` WHERE `id_tipo` = ?";
                  $query = $this->db->query($sentence,array($idTipo));
            }
            else{
                  return NULL;
            }
      }

      public function modificarTipoDeHospedaje($idTipo,$tipoNuevo)
      {
            if (!empty($this->existeTipo($idTipo))) {
      	     $sentence = "UPDATE  `couchInn`.`tipo_de_couch` SET  `tipo` =  ? WHERE  `tipo_de_couch`.`id_tipo` = ?";
      	     $query = $this->db->query($sentence, array($tipoNuevo,$idTipo));
            }
      }
}