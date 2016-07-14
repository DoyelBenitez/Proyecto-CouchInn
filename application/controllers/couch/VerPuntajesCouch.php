<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerPuntajesCouch extends CI_Controller {

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
		$this->load->model('reservas/puntajes_model');
		$this->load->model('sesiones/sesiones_model');
		$this->load->model('couchs_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
	 }

	public function index($id_couch)
	{
		$data['title'] = 'Ver Usuario';
		$data['page_header'] = '';

		//Voy a buscar sus puntajes con comentario
		$data['puntajes'] = $this->puntajes_model->getPuntajesACouch($id_couch);

		$data['id_couch'] = $id_couch;

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/couch/verPuntajesCouch',$data);
		$this->load->view('templates/footer.php', $data);
	}

	public function _remap($param) 
	{
		$this->index($param);
	}
}

?>