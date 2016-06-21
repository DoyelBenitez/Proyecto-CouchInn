<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {


	public function __construct(){
        parent::__construct();
        $this->load->model('couchs_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->model('sesiones/sesiones_model');
     }

	public function index()
	{
		$data['title'] = 'CouchInn';
		$data['page_header'] = '';
		$data['couchs'] = $this->couchs_model->getCouchs();

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/inicio',$data);
		$this->load->view('templates/footer.php', $data);
	}
}
