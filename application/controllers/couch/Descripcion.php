<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Descripcion extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('couchs_model');
        $this->load->model('sesiones/sesiones_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
     }	

	public function index(){
		

		$id = $_POST['id_couch'];
		
		//Me quedo con las imagenes del couch
		$data['imagenes'] = $this->couchs_model->getCouchImagenes($id);


		//Voy a buscar el couch
		$couch = $this->couchs_model-> getCouch($id);
		$couch = reset($couch);
		$data ['couch'] = $couch;

		//Me quedo con el usuario que publico el couch
		$usuario = $this->sesiones_model->getUserById($couch->id_usuario);
		$data['usuario'] = reset($usuario);

		$data['title'] = $couch->titulo;
		$data['page_header'] = '';

		//print_r($data['imagen'][0]->imagen);
		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/couch/verImagenes', $data);
		$this->load->view('paginas/couch/verDescripcion', $data);
		$this->load->view('templates/footer.php', $data);
	}
}
