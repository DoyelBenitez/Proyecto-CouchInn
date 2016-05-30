<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgregarTipo extends CI_Controller {

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

			$data['title'] = 'Agregar Tipo de Hospedaje';
			$data['page_header'] = '';

			$this->form_validation->set_rules('tipo', 'tipo', 'callback_tipo_check|alpha|required');

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header.php', $data);
				$this->load->view('paginas/tipos/agregarTipo');
				$this->load->view('templates/footer.php', $data);
			}
			else
			{
				$tipo = strtolower($_POST['tipo']);
				$this->tipos_model->agregarTipoDeHospedaje($tipo);
				echo "<script> alert('El tipo ".$tipo." ha sido agregado satisfactoriamente'); window.location.href = '" . base_url() . "index.php/tipos/listarTipos'; </script>";
			}
		}
    }

    public function tipo_check($str)
	{
		$tipo = strtolower($str);
		if (!empty($this->tipos_model->existeNombreTipo($tipo)))
		{
			$this->form_validation->set_message('tipo_check', 'El tipo ingresado ya se encuentra en el sistema.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
