<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrarse extends CI_Controller {

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
		$data['title'] = 'Registrarse en el sistema';
		$data['page_header'] = '';

		//Pongo las reglas a seguir para validar los campos
		$this->form_validation->set_rules('email', 'email', 'valid_email|required|callback_existeUsuario');
		$this->form_validation->set_rules('nombre', 'nombre', 'alpha|required');
		$this->form_validation->set_rules('apellido', 'apellido', 'alpha|required');
		$this->form_validation->set_rules('fecha_nac', 'fecha de nacimiento', 'required');
		$this->form_validation->set_rules('telefono', 'telefono', 'numeric|required');
		$this->form_validation->set_rules('passw', 'contraseña', 'required|alpha_numeric|min_length[5]');
		$this->form_validation->set_rules('passwconf', 'confirmacion de contraseña', 'required|alpha_numeric|min_length[5]|matches[passw]');

		//Si no se pasó la validación
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('templates/header.php', $data);
			$this->load->view('paginas/sesiones/registrarse');
			$this->load->view('templates/footer.php', $data);
		}
		//Si ya se validaron todos los campos creo el usuario y lo logeo
		else
		{
			//Preparo los datos a cargar en la sesión
				$usuario = array(
							'nombre' 			=> $_POST['nombre'],
							'apellido' 			=> $_POST['apellido'],
							'email' 			=> $_POST['email'],
							'passw'				=> $_POST['passw'],
							'telefono'			=> $_POST['telefono'],
							'fecha_nacimiento'	=> $_POST['fecha_nac']
							 );
			
			//Seteo por defecto el tipo en comun
			$usuario['tipo'] = 'comun';

			//Agrego el usuario a la base
			$this->sesiones_model->agregarUsuario($usuario);

			//Logueo al usuario
			$this->session->set_userdata($usuario);
			echo "<script> alert('Se ha registrado satisfactoriamente en el sistema'); </script>";

			//Checkeo si quiere ser premium
			if (!empty($_POST['tipo'])) 
			{
				
				echo "<script> window.location.href = '". site_url('index.php/sesiones/comprarPremium'). "'; </script>";
			}
			else
			{
				//Redirigo a la pagina principal
				echo "<script> window.location.href = '". base_url(). "'; </script>";
			}
		}
		
	}

	public function existeUsuario($email)
	{
		//Función que checkea que exista el usuario con la contraseña que ingresó en la base
		if (!empty($this->sesiones_model->getUser($email))) 
		{
			//Si no existe imprimo el mensaje siguiente:
			$this->form_validation->set_message('existeUsuario','El usuario ya existe.');
			return FALSE;	
		}
		else
		{
			return TRUE;
		}
	}
}