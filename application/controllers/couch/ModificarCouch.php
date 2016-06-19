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
		$this->load->model('couchs_model');
     }

	public function index($id_couch)
	{
		/*
		//Tomo usuario del couch
		$usuarioLogueado = $this->session->userdata('email');
		if(!empty($usuarioLogueado)) {
			$usuarioDueño = $this->couchs_model->getUserOfCouch($id_couch);
			$usuarioDueño = reset($usuarioDueño);
		}
		else
		{
			//No es el dueño del couch el que está en esta página
			echo "<script> alert('No tiene permisos para estar aquí'); window.location.href = '". base_url(). "'; </script>";
		}
			if ($usuarioDueño->email == $usuarioLogueado) 
			{*/
		
				//Pongo titulo de pagina
				$data['title'] = 'Modificar datos de couch';
				$data['page_header'] = '';

				$couch = $this->couchs_model->getCouch($id_couch);
				$couch = reset($couch);
				$data['couch'] = $couch;

				//Pongo las reglas a seguir para validar los campos
				$this->form_validation->set_rules('titulo', 'titulo', 'alpha');
			 	$this->form_validation->set_rules('descripcion', 'descripcion', 'alpha_numeric');
			 	$this->form_validation->set_rules('localidad', 'localidad', 'alpha');
			 	$this->form_validation->set_rules('capacidad', 'capacidad', 'numeric');
			 	//$this->form_validation->set_rules('tipo', 'tipo', );
			 	//$this->form_validation->set_rules('imagen1', 'imagen principal',);

				//Si no se pasó la validación
				if ($this->form_validation->run() == FALSE) 
				{
					$this->load->view('templates/header.php', $data);
					$this->load->view('paginas/couch/modificarCouch');
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

						print_r(array_values($couch));
						
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
						else $tipo = $couch['5'];

						
						$couch = array (
							'id_couch'		=>	$couch[0],
							'titulo'		=>	$titulo,
							'descripcion'	=>	$descripcion,
							'capacidad'		=>	$capacidad,
							'localidad'		=>	$localidad,
							'id_tipo'		=>	$tipo,
							'id_usuario'	=>	$couch[6],
							'estado'		=>	$couch[7]
							);
						echo '///////';
						print_r(array_values($couch));

						//Agrego el couch a la base

						$this->couchs_model->agregarCouch($couch);

						//Tiro mensaje de exito
						echo "<script> alert('Se han modificado los datos del couch satisfactoriamente en el sistema'); </script>";
					}
					else
					{
						//Mensaje de que no se modifico nada
						echo "<script> alert('No se han modificado los datos del couch'); </script>";
					}
					//Redirigo a la pagina principal
					//echo "<script> window.location.href = '". base_url(). "'; </script>";
				}
			}
			/*
			else
			{
				//No es el dueño del couch el que está en esta página
				echo "<script> alert('No tiene permisos para estar aquí'); window.location.href = '". base_url(). "';  </script>";
			}
			*/
	public function _remap($param) 
	{
		$this->index($param);
	}
}