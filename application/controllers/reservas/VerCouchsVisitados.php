<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerCouchsVisitados extends CI_Controller {

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
		$data['title'] = 'Mis reservas de couchs';
		$data['page_header'] = '';

		//Saco el id del usuario logueado
		$usuario = $this->sesiones_model->getUser($this->session->userdata('email'));
		$id_usuario = reset($usuario)->id_usuario;
		$data['id_usuario'] = $id_usuario;

		//Voy a buscar las reservas que hice
		$data['reservas'] = $this->reservas_model->getReservasVencidasDeUsuario($id_usuario);

		//Me quedo con los puntajes para ver si el usuario ya puntuó las reservas vencidas
		$data['puntajes'] = $this->puntajes_model->getPuntajesCouchs();

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/reservas/verCouchsVisitados', $data);
		$this->load->view('templates/footer.php', $data);
	}
}
