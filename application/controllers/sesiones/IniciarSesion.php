<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IniciarSesion extends CI_Controller {

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
		$data['title'] = 'Iniciar Sesión en el sistema';
		$data['page_header'] = '';

		//Pongo las reglas a seguir para validar los campos
		$this->form_validation->set_rules('email', 'email', 'valid_email|required');
		$this->form_validation->set_rules('passw', 'contraseña', 'required|alpha_numeric|min_length[5]|callback_existeUsuario');

		//Si no se pasó la validación
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('templates/header.php', $data);
			$this->load->view('paginas/sesiones/iniciarSesion');
			$this->load->view('templates/footer.php', $data);
		}
		//Si ya se validaron todos los campos creo las sesión del usuario
		else
		{
			//Lo recupero de la base
			$datos = $this->sesiones_model->getUserWithPass($_POST['email'],$_POST['passw']);
			//Este for no deberia ser necesario, pero $datos tiene un arreglo de arreglos, de tamaño 1 :/
			foreach ($datos as $dato) {
				//Preparo los datos a cargar en la sesión
				$usuario = array(
							'nombre' 			=> $dato->nombre,
							'apellido' 			=> $dato->apellido,
							'email' 			=> $dato->email,
							'passw'				=> $dato->passw,
							'telefono'			=> $dato->telefono,
							'fecha_nacimiento'	=> $dato->fecha_nacimiento,
							'tipo'				=> $dato->tipo,
							 );
				//Seteo la sesión con el arreglo que acabo de preparar ($usuario)
				$this->session->set_userdata($usuario);
			}
			//Pongo mensaje de alerta y redirijo al inicio
			echo "<script> alert('Sesión iniciada correctamente'); window.location.href = '" . base_url()."' </script>";
		}
		
	}

	public function existeUsuario($passw)
	{
		//Función que checkea que exista el usuario con la contraseña que ingresó en la base
		if (empty($this->sesiones_model->getUserWithPass($_POST['email'],$passw))) 
		{
			//Si no existe imprimo el mensaje siguiente:
			$this->form_validation->set_message('existeUsuario','Usuario o contraseña incorrectos.');
			return FALSE;	
		}
		else
		{
			return TRUE;
		}
	}
}