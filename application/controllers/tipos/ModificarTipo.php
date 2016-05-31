<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModificarTipo extends CI_Controller {

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

	public function index($tipoViejo)
 	{ 

 		//Control de que solo acceda el admin
        $tipoUsuario = $this->session->userdata('tipo');
        if ($tipoUsuario != 'admin')
        {
            echo "<script> alert('Usted no tiene los permisos para entrar aquí'); window.location.href = '" .base_url(). "';</script>";
        }
        else
        {
	 		$data['title'] = 'Modificar Tipo de Hospedaje';
			$data['page_header'] = '';

			//Checkeo requerido para no perder el tipoViejo despues de validacion erronea
			if (empty($_POST['tipoViejo'])) {
				$data['tipoViejo'] = $tipoViejo;
			}
			else
			{
				$data['tipoViejo'] = $_POST['tipoViejo'];
			}


	 		$this->form_validation->set_rules('tipo', 'tipo', 'callback_tipo_check|alpha|required');
	 		$this->form_validation->set_rules('tipoViejo', 'tipo viejo', 'required');

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header.php', $data);
				$this->load->view('paginas/tipos/modificarTipo', $data);
				$this->load->view('templates/footer.php', $data);
			}
	     	else
	     	{
	     		$tipo = $_POST['tipoViejo'];
	     		$tipoNuevo = strtolower($_POST['tipo']);
		   		$this->tipos_model->modificarTipoDeHospedaje($tipo,$tipoNuevo);	
		     	echo "<script> alert('El tipo ha sido modificado por satisfactoriamente'); window.location.href = '" . base_url() . "index.php/tipos/listarTipos'; </script>";
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

    public function _remap($param) 
    {
    	$this->index($param);
    }
}

?>