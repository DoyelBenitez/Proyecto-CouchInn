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

		public function getTodasLasImagenes(){ 
				$query = $this->db->query('SELECT * FROM imagenes_couchs');
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
				$query = $this->db->query('SELECT t.tipo, t.id_tipo FROM couch c inner join tipo_de_couch t on t.id_tipo = c.id_tipo WHERE c.id_tipo = ? ', array($id_couch));
				return $query->result();
		}

		public function agregarImagenACouchPorNumero($id_couch,$numero,$ruta_imagen)
		{
			$sentence =
			"INSERT INTO  `couchInn`.`imagenes_couchs` (
						`id_img` ,
						`id_couch` ,
						`numero`,
						`imagen`
						)
						VALUES (NULL , ?, ?, ?);";
			$query = $this->db->query($sentence, array($id_couch,$numero,$ruta_imagen));
		}

		public function modificarImagenACouchPorNumero($id_couch,$numero,$ruta_imagen)
		{
			if(!empty($this->existeImagenDeCouchPorNumero($id_couch,$numero)))
			{
				$sentence = "UPDATE couchInn.imagenes_couchs c SET imagen = ? WHERE c.id_couch = ? and c.numero = ?;";
				$query = $this->db->query($sentence, array($ruta_imagen,$id_couch,$numero));
			}
			else $this->agregarImagenACouchPorNumero($id_couch,$numero,$ruta_imagen);
		}

		public function existeImagenDeCouchPorNumero($id_couch,$numero)
		{
			$sentence = "SELECT * FROM imagenes_couchs c WHERE c.id_couch = ? and c.numero = ?";
			$query = $this->db->query($sentence, array($id_couch,$numero));
			return $query->result();
		}

		public function getCouchByName($titulo)
		{
			$query = $this->db->query("SELECT * FROM couch WHERE couch.estado = 'normal' and couch.titulo = ? ", array($titulo));
			return $query->result();
		}

		public function agregarCouch($couch)
		{
		   	$sentence =
		   	"INSERT INTO  `couchInn`.`couch` (
						`id_couch` ,
						`titulo` ,
						`descripcion` ,
						`capacidad` ,
						`localidad` ,
						`id_tipo` ,
						`id_usuario` ,
						`estado`
						)
			VALUES (NULL ,?,?,?,?,?,?,'normal');";
			$query = $this->db-> query($sentence, $couch);
		}

		public function eliminarCouch($id_couch)
		{
			//Si existe el couch lo borro
			if(!empty($this->getCouch($id_couch))){
				$sentence = "UPDATE `couchInn`.`couch` SET estado = 'borrado' WHERE `id_couch` = ?";
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
            $sentence = "SELECT c.* 
            			FROM comentarios c 
            				inner join couch co on c.id_couch = co.id_couch
            			WHERE c.id_couch = ? and co.estado = 'normal';";

            $query = $this->db->query($sentence, array($id_c));
            return $query->result();
        }

        public function getCouchsById_user($id_user){
        	$query = $this->db->query("SELECT * FROM couch WHERE couch.id_usuario = ?", array($id_user));
        	return $query->result();
        }

        public function getComentariosSinResponderById_couch($id_couch){
            $query = $this->db->query("SELECT * 
            							FROM comentarios c inner join couch co on c.id_couch = co.id_couch
            							WHERE c.id_couch = ? and c.respuesta = '' and co.estado = 'normal'",array($id_couch));
            return $query->result();

        }

        public function setRespuesta ($respuesta, $id_comentario){
        	$sentence = "UPDATE `comentarios` SET respuesta = ? WHERE id_comentario = ?"; 
        	$query = $this->db->query($sentence,array($respuesta,$id_comentario));
        }

        public function modificarCouch($couch)
		{
			$id_couch = $couch['id_couch'];
			if(!empty($couch['titulo'])) $this->setTitulo($couch['titulo'],$id_couch);
			if(!empty($couch['descripcion'])) $this->setDescripcion($couch['descripcion'],$id_couch);
			if(!empty($couch['localidad'])) $this->setLocalidad($couch['localidad'],$id_couch);
			if(!empty($couch['capacidad'])) $this->setCapacidad($couch['capacidad'],$id_couch);
			if(!empty($couch['imagen'])) $this->setImagen($couch['imagen'],$id_couch);
			if(!empty($couch['tipohospedaje'])) $this->setTipoHospedaje($couch['tipohospedaje'],$id_couch);
		}


		public function setTitulo($titulo,$id_couch)
		{
			$sentence = "UPDATE  `couchInn`.`couch` SET  `titulo` =  ? WHERE  `couch`.`id_couch` = ?;";
			$query = $this->db->query($sentence,array($titulo,$id_couch));
		}
		public function setDescripcion($descripcion,$id_couch)
		{
			$sentence = "UPDATE  `couchInn`.`couch` SET  `descripcion` =  ? WHERE  `couch`.`id_couch` = ?;";
			$query = $this->db->query($sentence,array($descripcion,$id_couch));
		}
		public function setLocalidad($localidad,$id_couch)
		{
			$sentence = "UPDATE  `couchInn`.`couch` SET  `localidad` =  ? WHERE  `couch`.`id_couch` = ?;";
			$query = $this->db->query($sentence,array($localidad,$id_couch));
		}
		public function setCapacidad($capacidad,$id_couch)
		{
			$sentence = "UPDATE  `couchInn`.`couch` SET  `capacidad` =  ? WHERE  `couch`.`id_couch` = ?;";
			$query = $this->db->query($sentence,array($capacidad,$id_couch));

		}

		public function setImagen($imagen,$id_couch)
		{
			$sentence = "UPDATE  `couchInn`.`couch` SET  `imagen` =  ? WHERE  `couch`.`id_couch` = ?;";
			$query = $this->db->query($sentence,array($imagen,$id_couch));

		}

		public function setTipoHospedaje($tipohospedaje,$id_couch)
		{
			$sentence = "UPDATE  `couchInn`.`couch` SET  `tipohospedaje` =  ? WHERE  `couch`.`id_couch` = ?;";
			$query = $this->db->query($sentence,array($tipohospedaje,$id_couch));
		}
}
