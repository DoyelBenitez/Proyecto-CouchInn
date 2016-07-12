<?php echo form_open('/index.php/admin/gananciasPremium/'); ?>



<div class="container" style="">
	<div class="form-group col-md-offset-3 col-md-6">
		<h2>Ver Ganancias:</h2>

		<br>
		<!-- Si ya mande las fechas muestro la ganancia -->
		<?php 
			if(is_numeric($ganancia)){
				echo '<p>Ganancia del período: <b>$'.$ganancia.'</b></p><br><br>';
			}
		?>

		
		<p>Por favor, ingrese las fechas para ver la ganancia de las compras premium en ese período: </p>

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

		<input type="submit" value="Ver ganancias" class="btn btn-default">
		</form>
	</div>
</div>