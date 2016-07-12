
<h3 style="text-align:center">Reservas del couch:</h3>
<br>
<div class="container" >

	<!--Botón para volver a la descripción -->
	<center>
		<?php echo form_open('/index.php/couch/descripcion/'); ?>
			<input type="hidden" name="id_couch" value="<?php echo $id_couch; ?>">
			<input type="submit" class="btn btn-default" value="Volver al couch" >
		</form>
	</center>
	<br>

	<ul class="list-group">

		<?php if(empty($reservas)) echo '<li class="list-group-item" style="text-align:center"> Nadie ha reservado este couch todavia </li>';
		else{
		?>
		
		<!-- Me quedo con el estado de la reserva actual para usar el estado como separador en el listado -->
		<?php
			$estadoActual = reset($reservas)->estado;
			echo '<li class="list-group-item"><b>'.ucfirst($estadoActual).'s: </b></li>';
		?>
			
		<?php foreach ($reservas as $key => $reserva) { ?>
		
			<?php
				//Si cambio el estado actual pongo separador
				if($estadoActual != $reserva->estado ){ 
					echo '<br>';
					echo '<li class="list-group-item"><b>'.ucfirst($reserva->estado).'s: </b></li>'; 
				}
			?>
			
				<li class="list-group-item" > 
				
				<!-- Datos de la reserva -->
				<?php 	echo '<b>'.($key+1).'. </b>'; 
						echo ' <b>Fecha de Inicio: </b>',$reserva->fecha_inicio;
						echo ' <b>Fecha de Fin: </b>',$reserva->fecha_fin;
						echo ' <b>Usuario: </b>',$reserva->email;
						echo ' <b>Estado: </b>',$reserva->estado;
				?>

				<div class="btn-toolbar" role="group" aria-label="...">
					

					<!-- Me quedo con el id del usuario logueado(dueño del couch) -->
					<?php 	
						$usuarioLogueado = $this->sesiones_model->getUser($this->session->userdata('email'));
						$id_usuario = reset($usuarioLogueado)->id_usuario;
					?>
					
					<!-- Si la reserva está pendiente me da la opción de rechazarla o aceptarla -->
					<?php if ($reserva->estado == 'pendiente') { ?>
						
						<!-- Boton aceptar -->
						<form method="post" action="<?php echo site_url('index.php/reservas/aceptarReserva/'); ?>">
							<input type="hidden" name="id_reserva" id="id_reserva" value="<?php echo $reserva->id_reserva; ?>">
							<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $id_couch; ?>">
							<input type="submit" class="btn btn-default" value="Aceptar reserva">
						</form>
						
						<!-- Boton rechazar -->
						<form method="post" action="<?php echo site_url('index.php/reservas/rechazarReserva/'); ?>">
							<input type="hidden" name="id_reserva" id="id_reserva" value="<?php echo $reserva->id_reserva; ?>">
							<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $id_couch; ?>">
							<input type="submit" class="btn btn-default" value="Rechazar reserva">
						</form>


					<?php } ?>
					
					<!-- Me fijo si ya lo puntuó a ese usuario -->
					<?php 
						$yaPuntuo = false;
						foreach ($puntajes as $key => $puntaje) {
							if(($puntaje->id_usuario_puntuado == $reserva->id_usuario) and ($puntaje->id_usuario == $id_usuario ))
							{
								$yaPuntuo = true;
							}
					} ?>
					
					<!-- Si no lo puntuó y la reserva está vencida muestro botón para puntuar al usuario -->
					<?php if (($reserva->estado == 'vencida') and (!$yaPuntuo)) { ?>
						<form method="post" action="<?php echo site_url('index.php/reservas/puntuarUsuario/'); ?>" >
							<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>">
							<!-- Le mando el id_couch para el boton volver atras del puntuar usuario-->
							<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $id_couch; ?>">
							<input type="hidden" name="id_usuario_puntuado" id="id_usuario_puntuado" value="<?php echo ($reserva->id_usuario); ?>">
							<input type="submit" class="btn btn-default" value="Puntuar usuario">
						</form>
					<?php } ?>
				</div>
					<br>
				</li>
				<?php $estadoActual = $reserva->estado ?>
			<?php } ?>
		<?php } //Del else?> 
	</ul>
</div>
<br>