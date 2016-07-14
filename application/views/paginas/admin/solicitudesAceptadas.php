<?php echo form_open('/index.php/admin/solicitudesAceptadas/'); ?>



<div class="container" style="">
	<div class="form-group col-md-offset-3 col-md-6">
		<h2>Solicitudes aceptadas:</h2>

		<br>

		<p>Por favor, ingrese las fechas para ver las reservas aceptadas en ese período: </p>

		<!--Fecha de inicio de la reserva -->

		<label for="fecha1"> Fecha uno: </label>
		<input type="date" name="fecha1" value="<?php if(isset($_POST['fecha1'])) echo $_POST['fecha1']; ?>" class="form-control" step="1" min="" max=<?php echo date('Y-m-d'); ?>"" />
		
			<?php if(!empty(form_error('fecha1'))){
				echo '<div class="alert alert-danger">';
				echo form_error('fecha1');
				echo '</div>';
			}
			?>
		<br>
		
		<!-- Fecha de fin de la reserva -->

		<label for="fecha2"> Fecha dos: </label>
		<input type="date" name="fecha2" value="<?php if(isset($_POST['fecha2'])) echo $_POST['fecha2']; ?>" class="form-control" step="1" min="" max="<?php echo date('Y-m-d'); ?>" />
		
			<?php if(!empty(form_error('fecha2'))){
				echo '<div class="alert alert-danger">';
				echo form_error('fecha2');
				echo '</div>';
			}
			?>
		<br>

		<input type="submit" value="Ver solicitudes" class="btn btn-default">
		</form>
		<br><br>


		<!-- Si ya mande las fechas muestro las aceptadas -->
		<?php 
		if(is_array($aceptadas)){
			if (sizeof($aceptadas) < 1) {
				echo '<p> <b>No ha habido reservas aceptadas durante ese período</b> </p>';
			}
			foreach ($aceptadas as $key => $reserva) {
		?>
				<ul class="list-group">

					<li class="list-group-item">
						<?php echo '<b> Couch: </b>'.$reserva->titulo. '<b> Usuario: </b>'.$reserva->email; ?>
					</li>

				</ul>
		<?php 
			}
		}
		?>

	</div>
</div>