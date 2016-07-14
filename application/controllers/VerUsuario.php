<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerUsuario extends CI_Controller {

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
		$this->load->helper('url_helper');
		$this->load->helper('form');
	 }

	public function index($id_usuario)
	{
		$data['title'] = 'Ver Usuario';
		$data['page_header'] = '';
		//Voy a buscar el usuario
		$usuario = $this->sesiones_model->getUserById($id_usuario);
		$data['usuario'] = reset($usuario);

		//Voy a buscar su puntaje promedio
		$puntaje = $this->puntajes_model->getPuntajePromedioUsuario($id_usuario);
		$data['puntajePromedio'] = reset($puntaje)->promedio;

		//Voy a buscar sus puntajes con comentario
		$data['puntajes'] = $this->puntajes_model->getPuntajesAUsuario($id_usuario);

		//Guardo el id_couch para poder volver a la pagina de ver reservas de ese couch
		$data['id_couch'] = $_POST['id_couch'];

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/verUsuario',$data);
		$this->load->view('templates/footer.php', $data);
	}

	public function _remap($param) 
	{
		$this->index($param);
	}
}

?>