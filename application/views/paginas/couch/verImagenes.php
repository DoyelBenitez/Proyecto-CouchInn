
<div class="container">
	<div class="  form-horizontal">

		<?php 
		//muestro las imagenes del couch
		foreach ($imagenes as $imagen) {  

				echo '<img src=" '. site_url($imagen->imagen).' " align="left" alt="imagen"  style="height:300px;width:300px" HSPACE="40" class="img-rounded" VSPACE="30" >';
		} ?>
	</div>
</div>
	
<?php 
		//me quedo con los datos del que esta logeado 
		$aux = $this->session->userdata() ;
		$usuarioTipo = $this->session->userdata('tipo');

			
	?>
		
<?php	
	//controlo que este logeado y no sea admin
	if ((count($aux) > 1) & ($usuarioTipo != 'admin') ) { ?> 
	
	<?php  	
		//Me quedo con el tipo y el nombre de usuario que esta logueado
		//me quedo con el email para poder averiguar el id del usuario (el userdata no lo te muestra)
		$userEmail = $this->session->userdata('email');
		$user_allDatos = $this->sesiones_model->getUserByEmail($userEmail);
		$userId_logeado = reset($user_allDatos)->id_usuario;
		$userId_couch =$couch->id_usuario; 
		
		if($userId_logeado == $userId_couch) { // si el usuario que esta logeado es el mismo que el del couch then?>
			
			<!-- Botón para ver las reservas del couch -->
			<div>
				<form method="post" action="<?php echo site_url('index.php/reservas/reservasCouch/').'/'.$couch->id_couch; ?>">
				<center><input type="submit" value="Ver reservas" class="btn btn-default"/></center>
				</form>
			</div>
			<br>
			<!-- Si tiene pregunta para responder le muestra la opcion -->
			<div class="container" style="text-align center"> 
				<div class="text-center">
				<a href="<?php echo site_url('index.php/couch/responderComentario'); ?>">
					<p> ¿Quieres responder? apreta aquí.</p>
				</a>
				</div>
			</div>
				
<?php	} 
		
		else 
		{ ?>

			<div>
			<center>
			<a href="<?php echo site_url('index.php/couch/reservarCouch/'.$couch->id_couch); ?>">
			<button class="btn btn-default"> Reservar </button>
			</a>
		</center>
			</div>

		<?php 
		} 
		?>

<?php
	} 
?>

	











		



