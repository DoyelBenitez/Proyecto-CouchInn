<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModificarCouch extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
        parent::__construct();
       	$this->load->helper('url');
       	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('tipos/tipos_model');
     }

	public function index($id_couch)
	{
	
		//Pongo titulo de pagina
		$data['title'] = 'Modificar datos de couch';
		$data['page_header'] = '';

		//Voy a buscar el couch
		$couch = $this->couchs_model->getCouch($id_couch);
		$couch = reset($couch);
		$data['couch'] = $couch;

		//Voy a buscar los tipos
		$data['tipos'] = $this->tipos_model->getTiposDeHospedaje();

		//Pongo las reglas a seguir para validar los campos
		$this->form_validation->set_rules('titulo', 'titulo', 'alpha');
	 	$this->form_validation->set_rules('descripcion', 'descripcion', 'alpha_numeric');
	 	$this->form_validation->set_rules('localidad', 'localidad', 'alpha');
	 	$this->form_validation->set_rules('capacidad', 'capacidad', 'numeric');
	 	$this->form_validation->set_rules('imagen1', 'imagen principal', 'callback_checkearImagen1');
	 	$this->form_validation->set_rules('imagen2', '2da imagen', 'callback_checkearImagen2');
	 	$this->form_validation->set_rules('imagen3', '3era imagen', 'callback_checkearImagen3');

		//Si no se pasó la validación
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('templates/header.php', $data);
			$this->load->view('paginas/couch/modificarCouch', $data);
			$this->load->view('templates/footer.php', $data);
		}
		//Si ya se validaron todos los campos
		else
		{
			//Checkeo si modifico algun campo
			$ingresoData = FALSE;
			foreach ($_POST as $campo) {
				if(!empty($campo)){
					$ingresoData = True;
				}
			}

			if ($ingresoData) {
				
				//Preparo los datos a cargar en el couch
				$couch = $_POST['couch'];
				
				if (!empty($_POST['titulo'])) {
					$titulo = $_POST['titulo'];
				}
				else $titulo = $couch['1'];
				if (!empty($_POST['descripcion'])) {
					$descripcion = $_POST['descripcion'];
				}
				else $descripcion = $couch['2'];
				if (!empty($_POST['capacidad'])) {
					$capacidad = $_POST['capacidad'];
				}
				else $capacidad = $couch['3'];
				if (!empty($_POST['localidad'])) {
					$localidad = $_POST['localidad'];
				}
				else $localidad = $couch['4'];
				if (!empty($_POST['tipo'])) {
					$tipo = $_POST['tipo'];
				}
				else $tipo = $couch['6'];
				
				//Checkeo de si cambio alguna de las 3 imagenes y cambio alguna agarro los datos del input y la guardo en la base
				if (!empty($_FILES['imagen1']['name']))
				{
					$nombreImagen = $_FILES['imagen1']['name'];
					$ruta_imagen['imagen1'] = "imagenes/couchs/".$nombreImagen;
					move_uploaded_file($_FILES['imagen1']["tmp_name"], $ruta_imagen['imagen1']);
					$imagen1 = $ruta_imagen['imagen1'];
					$id_couch = $couch[0];
					$numero = 1;
					$this->couchs_model->modificarImagenACouchPorNumero($id_couch,$numero,$imagen1);
				}
				if (!empty($_FILES['imagen2']['name']))
				{
					$nombreImagen = $_FILES['imagen2']['name'];
					$ruta_imagen['imagen2'] = "imagenes/couchs/".$nombreImagen;
					move_uploaded_file($_FILES['imagen2']["tmp_name"], $ruta_imagen['imagen2']);
					$imagen2 = $ruta_imagen['imagen2'];
					$id_couch = $couch[0];
					$numero = 2;
					$this->couchs_model->modificarImagenACouchPorNumero($id_couch,$numero,$imagen2);
				}
				if (!empty($_FILES['imagen3']['name']))
				{
					$nombreImagen = $_FILES['imagen3']['name'];
					$ruta_imagen['imagen3'] = "imagenes/couchs/".$nombreImagen;
					move_uploaded_file($_FILES['imagen3']["tmp_name"], $ruta_imagen['imagen3']);
					$imagen3 = $ruta_imagen['imagen3'];
					$id_couch = $couch[0];
					$numero = 3;
					$this->couchs_model->modificarImagenACouchPorNumero($id_couch,$numero,$imagen3);
				}

				
				$couch = array (
					'id_couch'		=>	$couch[0],
					'titulo'		=>	$titulo,
					'descripcion'	=>	$descripcion,
					'capacidad'		=>	$capacidad,
					'localidad'		=>	$localidad,
					'id_tipo'		=>	$tipo,
					'id_usuario'	=>	$couch[6],
					);

				//Agrego el couch a la base
				$this->couchs_model->modificarCouch($couch);

				//Tiro mensaje de exito
				echo "<script> alert('Se han modificado los datos del couch satisfactoriamente en el sistema'); </script>";
			}
			else
			{
				//Mensaje de que no se modifico nada
				echo "<script> alert('No se han modificado los datos del couch'); </script>";
			}
			//Redirigo a la pagina de mis couchs
			echo "<script> window.location.href = '". base_url('index.php/couch/listarCouchsDeUsuario'). "'; </script>";
		}
	}

	public function _remap($param) 
	{
		$this->index($param);
	}

	public function checkearImagen1()
	{
		$imagen = 'imagen1';
		if (isset($_FILES[$imagen])) 
		{
			$errors     = array();
			$acceptable = array(
				'image/jpeg',
				'image/jpg',
				'image/gif',
				'image/png');

			if((!in_array($_FILES[$imagen]['type'], $acceptable)) && (!empty($_FILES[$imagen]["type"]))) {
				$this->form_validation->set_message('checkearImagen1','Tipo de archivo inválido, solo JPG, GIF y PNG son formatos aceptados.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

	public function checkearImagen2()
	{
		$imagen = 'imagen2';
		if (isset($_FILES[$imagen])) 
		{
			$errors     = array();
			$acceptable = array(
				'image/jpeg',
				'image/jpg',
				'image/gif',
				'image/png');

			if((!in_array($_FILES[$imagen]['type'], $acceptable)) && (!empty($_FILES[$imagen]["type"]))) {
				$this->form_validation->set_message('checkearImagen2','Tipo de archivo inválido, solo JPG, GIF y PNG son formatos aceptados.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

	public function checkearImagen3()
	{
		$imagen = 'imagen3';
		if (isset($_FILES[$imagen])) 
		{
			$errors     = array();
			$acceptable = array(
				'image/jpeg',
				'image/jpg',
				'image/gif',
				'image/png');

			if((!in_array($_FILES[$imagen]['type'], $acceptable)) && (!empty($_FILES[$imagen]["type"]))) {
				$this->form_validation->set_message('checkearImagen3','Tipo de archivo inválido, solo JPG, GIF y PNG son formatos aceptados.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}

}