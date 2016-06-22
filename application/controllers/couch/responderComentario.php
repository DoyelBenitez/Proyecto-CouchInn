<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class responderComentario extends CI_Controller {

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
        $this->load->helper('url_helper');
        $this->load->model('sesiones/sesiones_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
     }

	public function index()
	{
		$this->form_validation->set_rules('respuesta', 'de respuesta', 'min_length[3]');

	//	print_r($_POST); TEST
		if($this->form_validation->run() == TRUE ) {
		//	echo 'PASO'; TEST

		
		$this->couchs_model->setRespuesta($_POST['respuesta'],$_POST['id_comentario']);
		echo "<script> alert('Comentario Respondido')</script>";
		}
		else {
	//	echo 'FALLO';	TEST
	}
		$data['title'] = 'CouchInn';
		$data['page_header'] = '';

		$this->load->view("paginas/couch/responderComentarios");
		$this->load->view('templates/footer.php', $data);

		
	}
}
