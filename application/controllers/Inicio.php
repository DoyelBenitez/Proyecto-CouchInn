<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {


	public function __construct(){
        parent::__construct();
        $this->load->model('couchs_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->model('sesiones/sesiones_model');
        $this->load->library('form_validation');
     }

	public function index()
	{
		$this->form_validation->set_rules('cantPersonas', 'cantPersonas', 'numeric');
		$this->form_validation->set_rules('Localidad', 'Localidad', 'alpha');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'alpha');
		$this->form_validation->set_rules('titulo', 'titulo', 'alpha');
		$this->form_validation->set_rules('desde', 'desde', 'callback_comprobarLosDosCamposCompletos');
		$this->form_validation->set_rules('hasta', 'hasta', 'callback_comprobarLosDosCamposCompletos');

		

		if($this->form_validation->run() == FALSE){ // entra cuando no se apreto el boton
			$data['title'] = 'CouchInn';
			$data['page_header'] = '';
			$data['couchs'] = $this->couchs_model->getCouchs();
			$data['imagenes'] = $this->couchs_model->getTodasLasImagenes();
		

			$this->load->view('templates/header.php', $data);
			$data['tipo'] = $this->couchs_model->getTipoDeCouch();
			$this->load->view('paginas/busqueda/vistaBusqueda', $data)	;
			$this->load->view('paginas/inicio',$data);
			$this->load->view('templates/footer.php', $data);
		}
		else{

				
				if (!empty($_POST[0])) 
				{
					unset($_POST[0]);	
				}
				$_POST['valido'] = 'true';
				//print_r($_POST);
		
				
				// EMPIEZO A BUSCAR POR TIPO

				$resuldatoID = array();

				if (!empty($_POST['cabaña']) or !empty($_POST['dpto']) or !empty($_POST['casa']) or !empty($_POST['Habitacion'])) {

					foreach ($_POST as $caso_prueba) // empiezo a buscar los parametros de busqueda
					{
					if (!empty($caso_prueba)) // si la variable Localidad contiene algo lo agrego al arreglo
					{	
	   					if (preg_match('/[0-9]{1}/', $caso_prueba) and ($caso_prueba != 99) and ($caso_prueba != 5) and ($caso_prueba != 10)) // si el valor es un tipo hago la busqueda 
						{	
							$caso_prueba = substr($caso_prueba, 0 , -1); // me quedo con el tipo
							$caso_prueba = $this->couchs_model->getCouchsByTipo($caso_prueba); //me quedo con el couch que cumple
							foreach ($caso_prueba as $couch) {
								array_push($resuldatoID,$couch );
							}
						} 
					}
					}
					if (empty($resuldatoID)) {
						$_POST['valido'] = 'false';
					}
				}


				
				//print_r($resuldatoID); // TEST
				
				// EMPIEZO A BUSCAR POR CAPACIDAD

				if (!empty($_POST['cantPersonas']) and $_POST['valido'] == 'true') //si se selecciono capacidad
				{
					
					if (!empty($resuldatoID)) //SI PREVIAMENTE SE SELECCINO UN TIPO, BUSQUEDA ANIDADA
					{	
						$resultAux = array();
						
						foreach ($resuldatoID as $couch )
				 		{	
				 			$temp =$this->couchs_model->getCouchsCumpleCapacidadById_couch($couch->id_couch, $_POST['cantPersonas']);
				 			
							if (!empty($temp)) // verifico que tenga algo para que no me llene el arreglo con nada
							{
								$temp = reset($temp);
								array_push($resultAux, $temp);
							}
						}
					$resuldatoID = $resultAux;
					
				  //print_r($resuldatoID); // TEST
						
						
					}
					else // SI NO, SOLO SE SELECCIONO capacidad
					{
						$resuldatoID = $this->couchs_model->getCouchsCumpleCapacidad($_POST['cantPersonas']);
					}
					if (empty($resuldatoID)) {
						$_POST['valido'] = 'false';
					}
				}
				
				// EMPIEZO A BUSCAR POR LOCALIDAD
				//print_r($resuldatoID); TEST

				if (!empty($_POST['Localidad']) and $_POST['valido'] == 'true')
				{
					if (!empty($resuldatoID)) // SI NO ESTA VACIO ES BUSQUEDA ANIDADA
					{
						$resultAux = array();
						foreach ($resuldatoID as $couch) 
						{
							//print_r($couch);
							$temp = $this->couchs_model->getCouchsByCumpleLocalidadById_couch($couch->id_couch, $_POST['Localidad']);
							if (!empty($temp))
							{
								$temp = reset($temp);
								array_push($resultAux, $temp);
							}
							
						}
						$resuldatoID = $resultAux;
					}
					else
						{
							$resuldatoID = $this->couchs_model->getCouchsCumpleLocalidad($_POST['Localidad']);
						}	
					if (empty($resuldatoID)) {
						$_POST['valido'] = 'false';
					}
					
				}

				//print_r($resuldatoID); //TEST
				 // print_r($_POST); TEST
				
				// EMPIEZO A BUSCAR POR TITULO

				if (!empty($_POST['titulo']) and $_POST['valido'] == 'true')
				{
					if (!empty($resuldatoID)) 
					{
						$resultAux = array();
						foreach ($resuldatoID as $couch) 
						{
							
							$temp = $this->couchs_model->getCouchsCumpleTituloById_couch($couch->id_couch ,$_POST['titulo']);
							if(!empty($temp))
							{
								$temp = reset($temp);
								array_push($resultAux, $temp);
							}
								
						}
						$resuldatoID = $resultAux;
						
					}
					else
					{
						$resuldatoID = $this->couchs_model->getCouchsCumpleTitulo($_POST['titulo']);
					}
					if (empty($resuldatoID)) {
						$_POST['valido'] = 'false';
					}					
				}
			//	print_r($_POST);//	TEST
				//print_r($resuldatoID); TEST

				//EMPIEZO A BUSCAR POR DESCRIPCION

				if (!empty($_POST['descripcion'])and $_POST['valido'] == 'true')
				{
					if (!empty($resuldatoID))
					{	
						$resultAux = array();
						foreach ($resuldatoID as $couch) 
						{	

							$temp=$this->couchs_model->getCouchsCumpleDescripcionById_Couch($couch->id_couch, $_POST['descripcion']);
							if (!empty($temp)) 
							{
								$temp = reset($temp);
								array_push($resultAux, $temp);
							}
						}
						$resuldatoID = $resultAux;
						
					}
					else
					{
						$resuldatoID = $this->couchs_model->getCouchsCumpleDescripcion($_POST['descripcion']);
					}
					if (empty($resuldatoID)) {
						$_POST['valido'] = 'false';
					}
				}
				//print_r($resuldatoID);

				//EMPIEZO A BUSCAR POR FECHA 

				if (!empty($_POST['desde']) and !empty($_POST['hasta']) and $_POST['valido'] == 'true') 
				{
					if (!empty($resuldatoID)) 
					{
						$resultAux = array();
						foreach ($resuldatoID as $couch) 
						{						
							$temp = $this->couchs_model->getCouchConDisponibilidadById_couchEn($couch->id_couch, $_POST['desde'], $_POST['hasta']); 
							if (!empty($temp)) 
							{

								$temp = reset($temp);
								array_push($resultAux, $temp);
							}
						}
						$resuldatoID = $resultAux;
					}
					else
					{
						$resuldatoID = $this->couchs_model->getCouchConDisponibilidadEn($_POST['desde'], $_POST['hasta']);
					}
				}

			//	print_r($resuldatoID); TEST
			//print_r($_POST);



			$data['title'] = 'CouchInnN';
			$data['page_header'] = '';
			$palabra= $_POST['boton'];
			$data['couchs'] = $resuldatoID;
			$data['post'] = $_POST;
			$data['imagenes'] = $this->couchs_model->getTodasLasImagenes();
			if (empty($data['couchs']))
			{
				$this->load->view('templates/header.php', $data);	
				$this->load->view('paginas/busqueda/busquedaVacia', $data);
				
			}
			else
			{	
				$this->load->view('templates/header.php', $data);
				$data['tipo'] = $this->couchs_model->getTipoDeCouch();
				$this->load->view('paginas/busqueda/vistaBusqueda', $data)	;
				$this->load->view('paginas/busqueda/busquedaPor', $data );
				$this->load->view('paginas/inicio',$data);
				$this->load->view('templates/footer.php', $data);
			}
		}
	}

	public function comprobarLosDosCamposCompletos()
	{
		if(!empty($_POST['desde']) and empty($_POST['hasta']) or empty($_POST['desde']) and !empty($_POST['hasta'] ))
		{
			return false;
		}
	}
}

