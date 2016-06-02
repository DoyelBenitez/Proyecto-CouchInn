<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Descripcion extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('couchs_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
     }	

	public function mostrar($id){
		$data['title'] = 'DescripcionCouch';
		$data['page_header'] = '';
		$data['imagen'] = $this->couchs_model->getCouchImagenes($id);
		$data ['couchs'] = $this->couchs_model-> getCouch($id);

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/couch/verImagenes', $data);
		$this->load->view('paginas/couch/verDescripcion', $data);
		$this->load->view('templates/footer.php', $data);
	}
}