<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayuda extends CI_Controller {


	public function __construct(){
        parent::__construct();
        $this->load->model('couchs_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->model('sesiones/sesiones_model');
     }

	public function index()
	{
		$data['title'] = 'Ayuda para usar CouchInn';
		$data['page_header'] = '';

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/ayuda',$data);
		$this->load->view('templates/footer.php', $data);
	}
}
