<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Descripcion extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('couchs_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
     }	

	public function index(){
		

		$id = $_POST['id_couch'];
		//echo "<script> alert('".$id."'); </script>";
		$data['imagen'] = $this->couchs_model->getCouchImagenes($id);

		$couch = $this->couchs_model-> getCouch($id);
		$data ['couchs'] = $couch;

		$data['title'] = reset($couch)->titulo;
		$data['page_header'] = '';

		//print_r($data['imagen'][0]->imagen);
		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/couch/verImagenes', $data);
		$this->load->view('paginas/couch/verDescripcion', $data);
		$this->load->view('templates/footer.php', $data);
	}
}
