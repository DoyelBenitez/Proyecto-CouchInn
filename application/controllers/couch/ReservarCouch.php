<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReservarCouch extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('reservas/reservas_model');
		$this->load->model('couchs_model');
		$this->load->model('sesiones/sesiones_model');
		$this->load->helper('url_helper');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('form_validation');
	 }	

	public function index($id_couch){
		
	if(empty($this->session->userdata())){

	}

		//Seteo titulo y header
		$data['title'] = 'Reservar couch';
		$data['page_header'] = '';

		//Me quedo con el couch a reservar
		$couch = $this->couchs_model->getCouch($id_couch);
		$data['couch'] = reset($couch);

		//Me quedo con las reservas del couch
		$data['reservas'] = $this->reservas_model->getReservasAceptadasDeCouch($id_couch);

		$this->form_validation->set_rules('fecha_inicio', 'fecha inicio', 'required');
		$this->form_validation->set_rules('fecha_fin', 'fecha fin', 'required|callback_fechaFinEsMayorAInicio');
		$this->form_validation->set_rules('id_couch', 'id_couch', 'callback_hayDisponibilidad');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('templates/header.php', $data);
			$this->load->view('paginas/couch/reservarCouch', $data);
			$this->load->view('templates/footer.php', $data);
		}
		else
		{
			$fecha_inicio = $this->input->post('fecha_inicio'); 
			$fecha_fin = $this->input->post('fecha_fin');
			$id_couch= $this->input->post('id_couch');
			
			$usuario = $this->sesiones_model->getUser(($this->session->userdata('email')));
			$usuario = reset($usuario);
			$id_usuario = $usuario->id_usuario;

			$datos = array(
					'id_couch' 		=> $id_couch,
					'id_usuario'	=> $id_usuario,
					'fecha_inicio'	=> $fecha_inicio,
					'fecha_fin'		=> $fecha_fin
					);
			$this->reservas_model->agregarReserva($datos);
			echo "<script> alert('¡El couch se ha reservado satisfactoriamente!') </script>";
			echo "<script> window.location.href = '". base_url()."index.php/reservas/verMisReservas/'; </script>";
		}

	}

	public function hayDisponibilidad()
	{
		$fecha_inicio = $this->input->post('fecha_inicio'); 
		$fecha_fin = $this->input->post('fecha_fin');
		$id_couch= $this->input->post('id_couch');
		
		//Me fijo si ya hay reservas aceptadas en ese rango
		$reservas = $this->reservas_model->getReservasAceptadasEntre2FechasParaCouch($fecha_inicio,$fecha_fin,$id_couch);

		//Si hay diponibilidad
		if(empty($reservas)){
			return true;
		}
		//Sino
		else
		{
			$this->form_validation->set_message('hayDisponibilidad','No hay disponibilidad para esa fecha.');
			return false;
		}
	}

	
	public function fechaFinEsMayorAInicio()
	{
		$fecha_inicio = $this->input->post('fecha_inicio'); 
		$fecha_fin = $this->input->post('fecha_fin');
		if($fecha_inicio < $fecha_fin)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('fechaFinEsMayorAInicio','La fecha de fin no puede ser anterior o igual a la de inicio.');
			return false;
		}
	}

	public function _remap($param) 
	{
		$this->index($param);
	}
}