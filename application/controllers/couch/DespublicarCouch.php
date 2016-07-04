<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DespublicarCouch extends CI_Controller {

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
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('couchs_model');
	 }

	 public function index()
	 {
	 	//Control de que sea usuario del sistema y no admin
	 	$usuarioTipo = $this->session->userdata('tipo');
	 	if ($usuarioTipo == 'comun' or $usuarioTipo == 'premium') 
	 	{
	 		//Me quedo con el id que recibo de la vista
	 		$id_couch = $_POST['id_couch'];
	 		
	 		//Lo elimino de la base lógicamente
	 		$this->couchs_model->despublicarCouch($id_couch);

	 		//Imprimo mensaje y redirigo
	 		echo "<script> alert('El couch fue despublicado correctamente'); window.location.href = '" .base_url()."index.php/couch/listarCouchsDeUsuario';</script>"; 
	 	}
	 	else
	 	{
	 		echo "<script> alert('Usted no tiene los permisos para entrar aquí'); window.location.href = '" .base_url(). "';</script>";
	 	}
	 }
}