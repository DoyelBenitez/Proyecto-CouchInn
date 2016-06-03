<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModificarCuenta extends CI_Controller {

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
		$this->load->model('sesiones/sesiones_model');
     }

	public function index()
	{
		//Pongo titulo de pagina
		$data['title'] = 'Modificar datos de su cuenta';
		$data['page_header'] = '';

		//Pongo las reglas a seguir para validar los campos
		$this->form_validation->set_rules('nombre', 'nombre', 'alpha');
		$this->form_validation->set_rules('apellido', 'apellido', 'alpha');
		$this->form_validation->set_rules('fecha_nac', 'fecha de nacimiento');
		$this->form_validation->set_rules('telefono', 'telefono', 'numeric');
		$this->form_validation->set_rules('passw', 'nueva contraseña', 'alpha_numeric|min_length[5]|matches[passwconf]');
		$this->form_validation->set_rules('passwconf', 'confirmacion de contraseña', 'alpha_numeric|min_length[5]|matches[passw]');

		//Si no se pasó la validación
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('templates/header.php', $data);
			$this->load->view('paginas/sesiones/modificarCuenta');
			$this->load->view('templates/footer.php', $data);
		}
		//Si ya se validaron todos los campos creo el usuario y lo logeo
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
				
				//Preparo los datos a cargar en la sesión
				$usuario = $this->session->userdata();
				
				if (!empty($_POST['nombre'])) {
					$usuario['nombre'] = $_POST['nombre'];
				}
				if (!empty($_POST['apellido'])) {
					$usuario['apellido'] = $_POST['apellido'];
				}
				if (!empty($_POST['email'])) {
					$usuario['email'] = $_POST['email'];
				}
				if (!empty($_POST['passw'])) {
					$usuario['passw'] = $_POST['passw'];
				}
				if (!empty($_POST['telefono'])) {
					$usuario['telefono'] = $_POST['telefono'];
				}
				if (!empty($_POST['fecha_nac'])) {
					$usuario['fecha_nacimiento'] = $_POST['fecha_nac'];
				}


				//Agrego el usuario a la base
				$this->sesiones_model->modificarUsuario($usuario);

				//Logueo al usuario
				$this->session->set_userdata($usuario);
				echo "<script> alert('Se han modificado los datos satisfactoriamente en el sistema'); </script>";
			}
			else
			{
				echo "<script> alert('No se han modificado los datos del usuario'); </script>";
			}
			//Redirigo a la pagina principal
			echo "<script> window.location.href = '". base_url(). "'; </script>";
		}
		
	}
}