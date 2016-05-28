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

      public function existeTipo($tipo)
      {
            $sentence = "SELECT t.tipo FROM tipo_de_couch t WHERE t.tipo = ?";
            $query = $this->db->query($sentence,array($tipo));
            return $query->result();
      }

	public function agregarTipoDeHospedaje($tipo)
	{
		if (empty($this->existeTipo($tipo))) {
				$sentence = "INSERT INTO `couchInn`.`tipo_de_couch` (`id_tipo`, `tipo`) VALUES (NULL, ? )";
				$query = $this->db->query($sentence,array($tipo));
		}
		else{
			return NULL; 
		    }
	}

	public function eliminarTipoDeHospedaje($tipo)
      {
            if (!empty($this->existeTipo($tipo))) {
                  $sentence = "DELETE FROM `couchInn`.`tipo_de_couch` WHERE `tipo` = ?";
                  $query = $this->db->query($sentence,array($tipo));
            }
            else{
                  return NULL;
            }
      }

      public function modificarTipoDeHospedaje($tipo,$tipoNuevo)
      {
            if (!empty($this->existeTipo($tipo))) {
      	     $sentence = "UPDATE  `couchInn`.`tipo_de_couch` SET  `tipo` =  ? WHERE  `tipo_de_couch`.`tipo` = ?";
      	     $query = $this->db->query($sentence, array($tipoNuevo,$tipo));
            }
      }
}