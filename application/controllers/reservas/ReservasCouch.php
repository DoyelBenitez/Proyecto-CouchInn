<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReservasCouch extends CI_Controller {

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
		$this->load->model('reservas/reservas_model');
		$this->load->model('reservas/puntajes_model');
	 }

	public function index($id_couch)
	{
		//Pongo titulo de pagina
		$data['title'] = 'Reservas del couch ';
		$data['page_header'] = '';

		//Voy a buscar las reservas del couch
		$data['reservas'] = $this->reservas_model->getReservasDeCouch($id_couch);

		//Voy a buscar los puntajes a usuarios
		$data['puntajes'] = $this->puntajes_model->getPuntajesUsuario();

		//Guardo el id_couch para el boton volver atras del puntuar usuario
		$data['id_couch'] = $id_couch;

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/reservas/verReservasCouch',$data);
		$this->load->view('templates/footer.php', $data);
	}

	public function _remap($param) 
	{
		$this->index($param);
	}
}
