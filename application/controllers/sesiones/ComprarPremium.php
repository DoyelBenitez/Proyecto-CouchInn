<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComprarPremium extends CI_Controller {

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
     	if($this->session->userdata('tipo') == 'comun')
     	{
	     	//Titulo y encabezado
	     	$data['title'] = 'Adquirir el servicio Premium';
	     	$data['page_header'] = '';

	     	//Reglas de validacion
	     	$this->form_validation->set_rules('compania', 'compania', 'required');
	     	$this->form_validation->set_rules('tarjeta', 'número de tarjeta', 'min_length[16]|required|numeric' );
	     	$this->form_validation->set_rules('pin', 'código de seguridad', 'min_length[3]|required|numeric');
	     	$this->form_validation->set_rules('fecha_ven', 'fecha de vencimiento', 'required');

			//Si no se pasó la validación
			if ($this->form_validation->run() == FALSE) {

				$this->load->view('templates/header.php',$data);
				$this->load->view('paginas/sesiones/comprarPremium.php',$data);
				$this->load->view('templates/footer.php',$data);

			}
			//Si ya se validaron todos los campos
			else
			{
				//Cambio el campo de comun a premium
				$usuario = $this->session->userdata();
				$email = $usuario['email'];
				$this->sesiones_model->makeUserPremium($email);
				//Agregar campo a la tabla con todos los pasos a premiums
				$id_usuario = $this->sesiones_model->getUser($email);
				$id_usuario = reset($id_usuario)->id_usuario;
				$precio = 10; //Precio random
				$this->sesiones_model->agregarCompraPremium($id_usuario,$precio);
				$usuario['tipo'] = 'premium';
				$this->session->set_userdata($usuario);
				echo "<script> alert('¡Has adquirido el servicio Premium!'); window.location.href = '" . base_url()."' </script>";
			}
		}
		else
		{
			echo "<script> alert('Usted no tiene los permisos para estar aquí.'); window.location.href = '" . base_url()."' </script>";
		}
     }
}
