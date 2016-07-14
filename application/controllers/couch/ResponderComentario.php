<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResponderComentario extends CI_Controller {

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
		

		// Lo tuve que hacer asi xq no me pasaba el id_couch es lo mismo que descripcion
			
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
					echo "<script> alert('Comentario enviado')</script>";	
					$aux['$_POST'] = $_POST['id_couch'];

					$_POST['booleano'] = "FALSE";
					$id = $_POST['id_couch'];
					$data['id_couch'] = $id;
					$data['page_header'] = '';
					$data['comentarios'] = $this->couchs_model->getComentarios($id);
					$data['estado'] = "FALSE";
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
					$data['id_couch'] = $id;
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
			}
				$this->load->view('templates/header.php', $data);
				$this->load->view('paginas/couch/verImagenes', $data);		
				$this->load->view('paginas/couch/verDescripcion', $data);
				$this->load->view('paginas/couch/verBotonComentar', $data);
				$this->load->view('paginas/couch/ver_Comentarios',$data);
				$this->load->view('templates/footer.php', $data);
	}
}