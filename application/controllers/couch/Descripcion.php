<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Descripcion extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('couchs_model');
        $this->load->model('reservas/puntajes_model');
        $this->load->model('sesiones/sesiones_model');
        $this->load->helper('url_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
     }	

	public function index()
	{
		$id = $_POST['id_couch'];
		
		//Me quedo con las imagenes del couch
		$data['imagenes'] = $this->couchs_model->getCouchImagenes($id);

		//Voy a buscar puntaje promedio del couch
		$promedio = $this->puntajes_model->getPuntajePromedioCouch($id);
		$data['promedio'] = reset($promedio)->promedio;
 
		//Voy a buscar el couch
		$couch = $this->couchs_model-> getCouch($id);
		$couch = reset($couch);
		$data ['couch'] = $couch;

		//Me quedo con el usuario que publico el couch
		$usuario = $this->sesiones_model->getUserById($couch->id_usuario);
		$data['usuario'] = reset($usuario);
		$data['title'] = $couch->titulo;

		
			$this->form_validation->set_rules('comentarios', 'comentarios', 'min_length[3]');	
			if($this->form_validation->run() == TRUE and !empty($_POST['comentarios']))
			{
				$comentario = $_POST['comentarios'];
				$id_user_couch = $_POST['id_couch'];
				$aux = $this->session->userdata() ;
				$usuarioTipo = $this->session->userdata('tipo');
			
				if ((count($aux) > 1))
				{
					$user_log = $this->session->userdata('email');
					$user_log = $this->sesiones_model->getId($user_log);
					$user_log = reset($user_log)->id_usuario;
					$this->couchs_model->setComentario($comentario,$id_user_couch,$user_log);
					$aux['$_POST'] = $_POST['id_couch'];
					echo "<script> alert('Comentario agregado'); window.location.href = '" .base_url(). "';</script>";
				}

			}
			else
			{
				if(!empty($_POST['booleano']))// si booleano existe quiere decir que se apreto ver mas comentarios
				{
					$id = $_POST['id_couch'];
					$data['page_header'] = '';
					$data['comentarios'] = $this->couchs_model->getComentarios($id);
					$data['estado'] = "TRUE";
				}
				else
				{// si no labura normalmente mostrandote 10 comentarios
					$_POST['booleano'] = "FALSE";
					$id = $_POST['id_couch'];
					$data['id_couch'] = $id;
					$data['page_header'] = '';
					$data['comentarios'] = $this->couchs_model->getComentarios($id);
					$data['estado'] = "FALSE";
				}
				$this->load->view('templates/header.php', $data);
				$this->load->view('paginas/couch/verImagenes', $data);		
				$this->load->view('paginas/couch/verDescripcion', $data);
				$this->load->view('paginas/couch/verBotonComentar', $data);
				$this->load->view('paginas/couch/ver_Comentarios',$data);
				$this->load->view('templates/footer.php', $data);	
		}
	}			
}
