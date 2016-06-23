<?php
class Couchs_Model extends CI_Model {

		public function __construct()
		{
				$this->load->database();
		}

		public function getCouchs(){
			$query = $this->db->query("SELECT * FROM couch WHERE couch.estado = 'normal';");
			return $query->result();
		}

		public function getCouch($id_couch){ //Funcion que se usa para la descripcion de un couch
			$query = $this->db->query("SELECT * FROM couch WHERE couch.estado = 'normal' and couch.id_couch = ? ", array($id_couch));
			return $query->result();
		}

		public function getCouchImagenes($id_couch){ 
				$query = $this->db->query('SELECT * FROM imagenes_couchs WHERE imagenes_couchs.id_couch = ? ', array($id_couch));
				return $query->result();
		}

		public function getUserOfCouch($id_couch)
		{
				$query = $this->db->query('	SELECT u.email 
											FROM couch c inner join usuario u on c.id_usuario = u.id_usuario
											WHERE c.id_couch = ? ', array($id_couch));
				return $query->result();
		}

		//usado en: verDescripcion,
		public function getTipoOfCouch($id_couch)
		{
				$query = $this->db->query('SELECT t.tipo, t.id_tipo FROM couch c inner join tipo_de_couch t WHERE c.id_tipo = ? ', array($id_couch));
				 return $query->result();
		}

		public function agregarImagenACouch($id_couch,$ruta_imagen)
		{
			$sentence =
			"INSERT INTO  `couchInn`.`imagenes_couchs` (
						`id_img` ,
						`id_couch` ,
						`imagen`
						)
						VALUES (NULL ,  ?,  ?);";
			$query = $this->db->query($sentence, array($id_couch,$ruta_imagen));
		}

		public function getCouchByName($titulo)
		{
			$query = $this->db->query("SELECT * FROM couch WHERE couch.estado = 'normal' and couch.titulo = ? ", array($titulo));
			return $query->result();
		}

		public function agregarCouch($couch)
		{
			print_r(array_values($couch));
		   	$sentence =
		   	"INSERT INTO  `couchInn`.`couch` (
						`id_couch` ,
						`titulo` ,
						`descripcion` ,
						`capacidad` ,
						`localidad` ,
						`imagen` ,
						`id_tipo` ,
						`id_usuario` ,
						`estado`
						)
			VALUES (NULL ,?,?,?,?,?,?,?,'normal');";
			$query = $this->db->query($sentence, $couch);
		}

		public function eliminarCouch($id_couch)
		{
			//Si existe el couch lo borro
			if(!empty($this->getCouch($id_couch))){
				$sentence = "UPDATE `test`.`couch` SET estado = 'borrado' WHERE `id_couch` = ?";
				$query = $this->db->query($sentence, array($id_couch));
			}
			else
			{
				return NULL;
			}
		}

		public function couchsDeUsuario($id_usuario)
		{
			$sentence = "SELECT * FROM couch WHERE couch.id_usuario = ? and couch.estado = 'normal';";
			$query = $this->db->query($sentence, array($id_usuario));
			return $query->result();
		}

		public function setComentario($comentario,$id_user_couch,$user_log)
        {
            $sentence =
             "INSERT INTO `comentarios` (
              `id_comentario` ,
              `id_couch` ,
              `id_usuario` ,
              `comentario`
                )
            VALUES (NULL , ?, ?, ?);";
            $query = $this->db->query($sentence, array($id_user_couch,$user_log,$comentario));
        }

        public function getComentarios($id_c)
        {
            $sentence = "SELECT * FROM comentarios WHERE id_couch = ?;";
            $query = $this->db->query($sentence, array($id_c));
            return $query->result();
        }

        public function getCouchsById_user($id_user){
        	$query = $this->db->query("SELECT * FROM couch WHERE couch.id_usuario = ?", array($id_user));
        	return $query->result();
        }

        public function getComentariosSinResponderById_couch($id_couch){
            $query = $this->db->query("SELECT * FROM comentarios WHERE id_couch = ? and comentarios.respuesta = ''",array($id_couch));
            return $query->result();

        }

        public function setRespuesta ($respuesta, $id_comentario){
        	$sentence = "UPDATE `comentarios` SET respuesta = ? WHERE id_comentario = ?"; 
        	$query = $this->db->query($sentence,array($respuesta,$id_comentario));
        }
}
