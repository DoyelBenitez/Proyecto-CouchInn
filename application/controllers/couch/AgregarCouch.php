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

		 	//Seteo validaciones
		 	$this->form_validation->set_rules('titulo', 'titulo', 'alpha|required');
		 	$this->form_validation->set_rules('descripcion', 'descripcion', 'alpha_numeric|required');
		 	$this->form_validation->set_rules('localidad', 'localidad', 'alpha|required');
		 	$this->form_validation->set_rules('capacidad', 'capacidad', 'numeric|required');
		 	$this->form_validation->set_rules('tipo', 'tipo', 'required');
		 	$this->form_validation->set_rules('imagen1', 'imagen principal', 'required');

		 	//Seteo la configuracion para la imagen
			$config['upload_path'] = 'imagenes/couchs';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2048';
			$config['max_width']  = '1920';
			$config['max_height']  = '1080';
			$this->load->library('upload', $config);

			//Si no se paso validacion
			if((!$this->upload->do_upload()) and ($this->form_validation->run() == FALSE))
			{
				if($this->input->post()== TRUE) $data['error'] = $this->upload->display_errors();
				$this->load->view('templates/header.php',$data);
				$this->load->view('paginas/couch/agregarCouch', $data);
				$this->load->view('templates/footer.php',$data);
			}

			//Si se validaron todos los campos
			else
			{
				$imagen = $this->upload->data();
				$ruta_imagen = "imagenes/couchs/".$imagen['file_name'];

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
						'id_tipo'		=> $id_tipo,
						'id_usuario'	=> $id_usuario
					);

				$this->couchs_model->agregarCouch($couch);
				$couch = $this->couchs_model->getCouchByName($couch['titulo']);
				$id_couch = reset($couch)->id_couch;
				$this->couchs_model->agregarImagenACouch($id_couch, $ruta_imagen);
				echo "<script> alert('¡El couch se ha agregado satisfactoriamente!') </script>";
				echo "<script> window.location.href = '". base_url(). "'; </script>";
			}
		}
		else
		{
			echo "<script> alert('Usted no tiene los permisos para entrar aquí'); window.location.href = '" .base_url(). "';</script>";
		}
	 }

}