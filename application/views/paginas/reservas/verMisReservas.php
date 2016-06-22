
<div class="container">

	<h3 style="text-align:center"> Mis reservas: </h3>
	<br>
	
	<ul class="list-group">
		
		<!-- Si no hizo ninguna reserva muestro este mensaje -->
		<?php 
			if(empty($reservas)){
				echo '<li class="list-group-item" style="text-align:center"> No tiene reservas realizadas todavía </li>';
		}?>	
		<!-- Sino muestro estas reservas -->
		<?php foreach ($reservas as $key => $reserva) { ?>
			

			<li class=" list-group-item" >
				<?php echo '<b>'.($key+1).'. Couch:</b> '. $reserva->titulo . ' <b>Inicio:</b> '. $reserva->fecha_inicio . ' <b>Fin:</b> '. $reserva->fecha_fin; ?>
				
				<?php $atributtes = array('style' => 'float:right'); ?>

				<?php echo form_open('/index.php/couch/descripcion',$atributtes); ?>
					<input type="hidden" id="id_couch" name="id_couch" value="<?php echo $reserva->id_couch; ?>">
					<input type="submit" class="btn btn-default" value="Ver Couch">
				</form>
				

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

				<?php } ?>
			</li>

		<?php  } ?>
		
		</div>

	</ul>
</div>