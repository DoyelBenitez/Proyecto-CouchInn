<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DarDeBajaUsuario extends CI_Controller {

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
		$this->load->model('sesiones/sesiones_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	 }

	 public function index()
	 {
 		$data['title'] = 'Darme de baja a CouchInn';
 		$data['page_header'] = '';

 		if(!isset($_POST['confirmar'])){
 			$this->load->view('templates/header.php', $data);
			$this->load->view('paginas/sesiones/darDeBajaUsuario',$data);
			$this->load->view('templates/footer.php', $data);
		}
 		else
 		{
 			if($_POST['confirmar'] == 'ok'){
		 		//Lo voy a buscar a la base
		 		$usuario = $this->sesiones_model->getUser($this->session->userdata('email'));
		 		$id_usuario = reset($usuario)->id_usuario;

				//Elimino usuario, sus couchs, rechazo reservas pendientes en sus couchs y cancelo sus reservas pendientes
				$this->sesiones_model->eliminarUsuarioById($id_usuario);
				$this->sesiones_model->eliminarCouchsDeUsuario($id_usuario);
				$this->sesiones_model->rechazarReservasDeCouchsDeUsuario($id_usuario);
				$this->sesiones_model->cancelarReservasDeUsuario($id_usuario);
				$this->session->sess_destroy();
				echo "<script> alert('El usuario ha sido eliminado satisfactoriamente'); window.location.href = '" . base_url(). "'; </script>";
			}
		}
	 }
}

?>