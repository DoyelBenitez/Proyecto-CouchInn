<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Descripcion extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('couchs_model');
        $this->load->helper('url_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
     }	

	public function index(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('comentarios', 'comentarios', 'required|min_length[1]');

		if($this->form_validation->run() == TRUE)
		{
		print_r($_POST);
		$comentario = $_POST['comentarios'];
		$id_user_couch = $_POST['id_couch'];
		//
		$aux = $this->session->userdata() ;
		$usuarioTipo = $this->session->userdata('tipo');
		if ((count($aux) > 1))
		{
			$user_log = $this->session->userdata('email');
			$user_log = $this->couchs_model->getId($user_log);
			$user_log = reset($user_log)->id_usuario;
			print_r($user_log);
			print_r($comentario);
			print_r($id_user_couch);
			$this->couchs_model->setDescripcion($comentario,$id_user_couch,$user_log);
			$aux['$_POST'] = $_POST['id_couch'];
			echo "<script> alert('Comentario agregado'); window.location.href = '" .base_url(). "';</script>";
		}

		}
		else
		{
			$id_c = $_POST['id_couch'];
		//echo "<script> alert('".$id."'); </script>";
		$data['id_couch'] = $id_c;
		$data['imagen'] = $this->couchs_model->getCouchImagenes($id_c);
		$couch = $this->couchs_model-> getCouch($id_c);
		$data ['couchs'] = $couch;
		$data['title'] = reset($couch)->titulo;
		$data['page_header'] = '';
		$data['comentarios'] = $this->couchs_model->getComentarios($id_c);

		//print_r($data['imagen'][0]->imagen);
		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/couch/verImagenes', $data);
		$this->load->view('paginas/couch/verDescripcion', $data);
		$this->load->view('paginas/couch/verBotonComentar', $data);
		$this->load->view('paginas/couch/ver_Comentarios', $data);
		//$this->load->view('templates/footer.php', $data);
		
		}	

		

	}
}
