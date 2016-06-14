<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListarCouchsDeUsuario extends CI_Controller {

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
		$this->load->model('couchs_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('couchs_model');
		$this->load->model('/sesiones/sesiones_model');
	 }

	 public function index()
	 {
	 	//Seteo titulo
	 	$data['title'] = 'Mis couchs';
	 	$data['page_header'] = '';

	 	//Me quedo con el id del usuario
	 	$emailUsuario = $this->session->userdata('email');
	 	print_r($emailUsuario);
	 	$usuario = $this->sesiones_model->getUser($emailUsuario);
		$id_usuario = reset($usuario)->id_usuario;

		$data['couchs'] = $this->couchs_model->couchsDeUsuario($id_usuario);

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/couch/listarCouchsDeUsuario',$data);
		$this->load->view('templates/footer.php', $data);
	 }
}