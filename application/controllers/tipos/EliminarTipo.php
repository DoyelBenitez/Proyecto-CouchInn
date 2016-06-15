<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EliminarTipo extends CI_Controller {

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
		$this->load->model('tipos/tipos_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	 }

	 public function index($idTipo)
	 {
		//Control de que solo acceda el admin
		$tipoUsuario = $this->session->userdata('tipo');
		if ($tipoUsuario != 'admin')
		{
			echo "<script> alert('Usted no tiene los permisos para entrar aquí'); window.location.href = '" .base_url(). "';</script>";
		}
		else
		{
			if(!empty($this->tipos_model->existeTipo($idTipo)))
			{
					$this->tipos_model->eliminarTipoDeHospedaje($idTipo);	
					echo "<script> alert('El tipo ha sido eliminado satisfactoriamente'); window.location.href = '" . base_url() . "index.php/tipos/listarTipos'; </script>";
			}
			else
			{
				
				echo "<script> alert('El tipo ".$idTipo." no está en el sistema'); window.location.href = '" . base_url() . "index.php/tipos/listarTipos'; </script>";
			}
		}
	 }

	public function _remap($param) 
	{
		$this->index($param);
	}
}

?>