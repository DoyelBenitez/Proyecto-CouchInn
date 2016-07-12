<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GananciasPremium extends CI_Controller {

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
		$this->load->model('sesiones/sesiones_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
	 }

	public function index()
	{
		//Control de que solo acceda el admin
		$tipoUsuario = $this->session->userdata('tipo');
		if ($tipoUsuario != 'admin')
		{
			echo "<script> alert('Usted no tiene los permisos para entrar aquí'); window.location.href = '" .base_url(). "';</script>";
		}
		else
		{
			$data['title'] = 'Ver ganancias del servicio Premium';
			$data['page_header'] = '';

			//Pongo las reglas a seguir para validar los campos
			$this->form_validation->set_rules('fecha1', 'fecha uno', 'required');
			$this->form_validation->set_rules('fecha2', 'fecha dos', 'required');

			if ($this->form_validation->run() == FALSE) 
			{
				$data['ganancia'] = 'not set';
				$this->load->view('templates/header.php', $data);
				$this->load->view('paginas/admin/gananciasPremium',$data);
				$this->load->view('templates/footer.php', $data);
			}

			else
			{
				$fecha1 = $_POST['fecha1']; 
				$fecha2 = $_POST['fecha2'];

				//Voy a buscarlo a la base
				$ganancia = $this->sesiones_model->gananciasPremiumEntreFechas($fecha1,$fecha2);
				$ganancia = reset($ganancia)->ganancia;

				//Si esta vacío le pongo 0
				if($ganancia == ''){
					$ganancia = 0;
				} 
				
				$data['ganancia'] = $ganancia;

				$this->load->view('templates/header.php', $data);
				$this->load->view('paginas/admin/gananciasPremium',$data);
				$this->load->view('templates/footer.php', $data);
			}
		}
	}

}

?>