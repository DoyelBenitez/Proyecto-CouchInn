
<div class="container">

	<h3 style="text-align:center"> Mis reservas: </h3>
	<br>
	
	<ul class="list-group">
		
		<!-- Si no hizo ninguna reserva muestro este mensaje -->
		<?php 
			if(empty($reservas)){
				echo '<li class="list-group-item" style="text-align:center"> No tiene reservas realizadas todavía </li>';
			}
		?>	
		
		<!-- Sino muestro estas reservas -->
		
		<!-- Uso la variable $couchActual para hacer un separador entre las reservas de los couchs -->
		<?php if(!empty($reservas)) $couchActual = reset($reservas)->id_couch;?>

		<?php foreach ($reservas as $key => $reserva) { ?>
			
			<!-- Si cambió el couchActual en el for hago un separador para distinguir las reservas de cada couch -->
			<?php 
				if ($reserva->id_couch != $couchActual) {
					echo '<li class=" list-group-item"> </li>';
				}
				?>
			
			<!-- Datos de la reserva -->
			<li class=" list-group-item" >

			<div class="btn-toolbar" role="group" aria-label="...">
					
				<?php echo '<b>'.($key+1).'. Couch:</b> '. $reserva->titulo . ' <b>Inicio:</b> '. $reserva->fecha_inicio . ' <b>Fin:</b> '. $reserva->fecha_fin; ?>
				
				<?php $atributtes = array('style' => 'float:right'); ?>
				
				<!-- Botón ver couch -->
				<?php echo form_open('/index.php/couch/descripcion',$atributtes); ?>
					<input type="hidden" id="id_couch" name="id_couch" value="<?php echo $reserva->id_couch; ?>">
					<input type="submit" class="btn btn-default" value="Ver Couch">
				</form>
				
				<!-- Botón puntuar y sus checkeos -->
				<?php 
					$yaPuntuo = false;
					foreach ($puntajes as $key => $puntaje) {
						if(($puntaje->id_usuario == $reserva->id_usuario) and ($puntaje->id_couch == $reserva->id_couch))
						{
							$yaPuntuo = true;
						}
				} ?>
				<?php if(($reserva->estado == 'vencida') and (!$yaPuntuo)){ ?>

					<?php echo form_open('/index.php/reservas/puntuarCouch',$atributtes); ?>
						<input type="hidden" id="id_couch" name="id_couch" value="<?php echo $reserva->id_couch; ?>">
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario; ?>">
						<input type="submit" class="btn btn-default" value="Puntuar">
					</form>

				<?php } $couchActual = $reserva->id_couch; ?>
			
			</div>

			</li>

		<?php  } ?>
		
		</div>

	</ul>
</div>