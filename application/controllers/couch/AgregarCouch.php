<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgregarCouch extends CI_Controller {

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
		$this->load->model('couchs_model');
		$this->load->helper(array('form', 'url', 'file'));
		$this->load->library('form_validation');
		$this->load->model('couchs_model');
		$this->load->model('tipos/tipos_model');
		$this->load->model('sesiones/sesiones_model');
	 }

	 public function index()
	 {
		//Control de que sea usuario del sistema y no admin
		$usuarioTipo = $this->session->userdata('tipo');
		if ($usuarioTipo == 'comun' or $usuarioTipo == 'premium') 
		{
			//Seteo titulo
			$data['title'] = 'Agregar un Couch';
			$data['page_header'] = '';
			$data['error'] = '';
			$data['tipos'] = $this->tipos_model->getTiposDeHospedaje();

			//Me guardo los nombres de los input de imagenes
			if (isset($_FILES['imagen1'])) $imagen1 = 'imagen1';

			//Seteo validaciones
			$this->form_validation->set_rules('titulo', 'titulo', 'alpha|required');
			$this->form_validation->set_rules('descripcion', 'descripcion', 'alpha_numeric|required');
			$this->form_validation->set_rules('localidad', 'localidad', 'alpha|required');
			$this->form_validation->set_rules('capacidad', 'capacidad', 'numeric|required');
			$this->form_validation->set_rules('tipo', 'tipo', 'required');
			if (empty($_FILES['imagen1']['name']))
			{
    			$this->form_validation->set_rules('imagen1', 'imagen principal', 'required');
			}
			else
			{
				$this->form_validation->set_rules('imagen1', 'imagen principal', 'callback_checkearImagen1');
			}
			$this->form_validation->set_rules('imagen2', '2da imagen', 'callback_checkearImagen2');
			$this->form_validation->set_rules('imagen3', '3era imagen ', 'callback_checkearImagen3');
			
			//Si no se paso validacion
			if($this->form_validation->run() == FALSE)
			{
				echo "<script> alert('No paso validacion') </script>";

				$this->load->view('templates/header.php',$data);
				$this->load->view('paginas/couch/agregarCouch', $data);
				$this->load->view('templates/footer.php',$data);
			}

			//Si se validaron todos los campos
			else
			{
				$imgPrincipal = 0;
				echo "<script> alert('Paso validacion') </script>";
				foreach($_FILES as $key => $value)
				{
					$nombreImagen = $_FILES[$key]['name'];
					if (!empty($nombreImagen)) {
						$ruta_imagen[$key] = "imagenes/couchs/".$nombreImagen;
					}
					$imgPrincipal = $key;
				}
				/*
				$imagen = $this->upload->data();
				$ruta_imagen = "imagenes/couchs/".$imagen['file_name'];
				*/
				$tipo = $this->tipos_model->getIdTipo($_POST['tipo']);
				$id_tipo = reset($tipo)->id_tipo;
				
				$emailUsuario = $_POST['usuario'];
				$usuario = $this->sesiones_model->getUser($emailUsuario);
				$id_usuario = reset($usuario)->id_usuario;
				
				$couch = array(
						'titulo' 		=> $_POST['titulo'],
						'descripcion' 	=> $_POST['descripcion'],
						'capacidad' 	=> $_POST['capacidad'],
						'localidad' 	=> $_POST['localidad'],	
						'imagen'		=> $ruta_imagen['imagen1'],
						'id_tipo'		=> $id_tipo,
						'id_usuario'	=> $id_usuario
					);
				$this->couchs_model->agregarCouch($couch);
				$couch = $this->couchs_model->getCouchByName($couch['titulo']);
				$id_couch = reset($couch)->id_couch;


				foreach($_FILES as $key => $ruta){
					if(isset($ruta_imagen[$key]))
					{
						print_r($ruta_imagen[$key]);
						move_uploaded_file($_FILES[$key]["tmp_name"], $ruta_imagen[$key]);
						$this->couchs_model->agregarImagenACouch($id_couch, $ruta_imagen[$key]);
					}
				}
				echo "<script> alert('¡El couch se ha agregado satisfactoriamente!') </script>";
				echo "<script> window.location.href = '". base_url(). "'; </script>";
			}
		}
		else
		{
			echo "<script> alert('Usted no tiene los permisos para entrar aquí'); window.location.href = '" .base_url(). "';</script>";
		}
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