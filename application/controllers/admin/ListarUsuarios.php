<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListarUsuarios extends CI_Controller {

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
        $this->load->helper('url_helper');
        $this->load->helper('form');
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
			$data['title'] = 'Eliminar usuario';
			$data['page_header'] = '';

			//Voy a buscar usuarios premium y comunes
			$data['comunes'] = $this->sesiones_model->getUsuariosComunes();
			$data['premiums'] = $this->sesiones_model->getUsuariosPremium();

			//Cargo las vistas
			$this->load->view('templates/header.php', $data);
			$this->load->view('paginas/admin/listarUsuarios',$data);
			$this->load->view('templates/footer.php', $data);
		}
	}
}

?>