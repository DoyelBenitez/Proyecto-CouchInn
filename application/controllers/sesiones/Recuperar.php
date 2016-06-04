<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recuperar extends CI_Controller {

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
	     	//Titulo y encabezado
	     	$data['title'] = 'Recuperar Contraseña';
	     	$data['page_header'] = '';

	     	//Reglas de validacion
	     	$this->form_validation->set_rules('email', 'email', 'valid_email|required');
	     	//Regla del codigo 
	     	//$this->form_validation->set_rules('pin', 'código de seguridad', 'min_length[3]|required|numeric');

			//Si no se pasó la validación
			if ($this->form_validation->run() == FALSE) {

				$this->load->view('templates/header.php',$data);
				$this->load->view('paginas/sesiones/recuperar.php',$data);
				$this->load->view('templates/footer.php',$data);

			}
			//Si ya se validaron todos los campos
			else
			{				
				//Mostrarle la contraseña y el email al usuario
				$user = $this->sesiones_model->getUser($_POST['email']);
				$contra = reset($user)->passw;
				$email = reset($user)->email;
				echo "<script> alert('Se ha recuperado la contraseña: ".$contra." para el email ".$email."'); window.location.href = '" . base_url()."'; </script>";
			}
	}

	public function existeUsuario($email)
	{
		//Función que checkea que exista el usuario con la contraseña que ingresó en la base
		$usuario = $this->sesiones_model->getUser($email);
		if (empty($usuario))	
		{
			//Si no existe imprimo el mensaje siguiente:
			$this->form_validation->set_message('existeUsuario','El email ingresado no se encuentra registrado en el sistema.');
			return FALSE;	
		}
		else
		{
			return TRUE;
		}
	}
		
}