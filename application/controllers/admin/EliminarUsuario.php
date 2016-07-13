<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EliminarUsuario extends CI_Controller {

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
		//Control de que solo acceda el admin
		$tipoUsuario = $this->session->userdata('tipo');
		if ($tipoUsuario != 'admin')
		{
			echo "<script> alert('Usted no tiene los permisos para entrar aquí'); window.location.href = '" .base_url(). "';</script>";
		}
		else
		{
			//Me traigo el id_usuario
			if(isset($_POST['id_usuarioC'])){
				$id_usuario = $_POST['id_usuarioC'];
			}
			else $id_usuario = $_POST['id_usuarioP'];

			//Elimino usuario, sus couchs, rechazo reservas pendientes en sus couchs y cancelo sus reservas pendientes
			$this->sesiones_model->eliminarUsuarioById($id_usuario);
			$this->sesiones_model->eliminarCouchsDeUsuario($id_usuario);
			$this->sesiones_model->rechazarReservasDeCouchsDeUsuario($id_usuario);
			$this->sesiones_model->cancelarReservasDeUsuario($id_usuario);
			echo "<script> alert('El usuario ha sido eliminado satisfactoriamente'); window.location.href = '" . base_url(). "'; </script>";
		}
	 }
}

?>