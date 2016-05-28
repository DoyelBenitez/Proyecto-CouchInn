<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->model('admin/tipos_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
     }

	public function listarTipos()
	{
		$data['title'] = 'Listar tipos';
		$data['page_header'] = '';
		$data['tipos'] = $this->tipos_model->getTiposDeHospedaje();

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/admin/listarTipos',$data);
		$this->load->view('templates/footer.php', $data);
	}

	public function eliminarTipo(){
		
		$data['title'] = 'Eliminar Tipo de Hospedaje';
		$data['page_header'] = '';

		$this->load->view('templates/header.php', $data);
		$this->load->view('paginas/admin/eliminarTipo');
		$this->load->view('templates/footer.php', $data);
	}

	public function eliminarTipoConDatos($tipo){
		$this->admin_model->eliminarTipoDeHospedaje($tipo);
		$this->listarTipos();
	}
}
