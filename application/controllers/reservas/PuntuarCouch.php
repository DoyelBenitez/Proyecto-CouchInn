<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PuntuarCouch extends CI_Controller {

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
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('sesiones/sesiones_model');
		$this->load->model('reservas/reservas_model');
		$this->load->model('reservas/puntajes_model');
	 }

	public function index()
	{
		//Pongo titulo de pagina
		$data['title'] = 'Puntuar un couch';
		$data['page_header'] = '';

		//Traigo los id_usuario y id_couch para puntuar
		$data['id_couch'] = $this->input->post('id_couch');
		$data['id_usuario'] = $this->input->post('id_usuario');

		//Checkeo de que ya entro una vez a la vista para que no muestre mensaje de error de una
		if (!empty($_POST['entro'])) {
			$data['mostrarError'] = TRUE;
		}
		else
		{
			$data['mostrarError'] = FALSE;	
		}

		//Pongo las reglas a seguir para validar los campos
		$this->form_validation->set_rules('puntaje', 'puntaje', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header.php', $data);
			$this->load->view('paginas/reservas/puntuarCouch');
			$this->load->view('templates/footer.php', $data);
		}
		else
		{
			$id_couch =	$_POST['id_couch'];
			$id_usuario = $_POST['id_usuario'];
			$puntaje = $_POST['puntaje'];
			$this->puntajes_model->agregarPuntaje($id_couch,$id_usuario,$puntaje);
			echo "<script> alert('Se ha puntuado el couch correctamente'); window.location.href = '" . site_url('/index.php/reservas/verMisReservas')."' </script>";
		}
	}
}
