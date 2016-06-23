<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AceptarReserva extends CI_Controller {

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
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('reservas/reservas_model');
	 }

	public function index()
	{
		//Pongo titulo de pagina
		$data['title'] = 'Aceptar reserva';
		$data['page_header'] = '';

		//Traigo el id_reserva y el id_couch
		$id_reserva = $_POST['id_reserva'];
		$id_couch = $_POST['id_couch'];

		//Lo cambio en la base
		$this->reservas_model->aceptarReserva($id_reserva);

		//Redirigo a la pagina anterior
		echo "<script> alert('¡Se ha aceptado la reserva satisfactoriamente!') </script>";
		echo "<script> window.location.href = '". base_url()."index.php/reservas/reservasCouch/".$id_couch."'; </script>";
	}
}
