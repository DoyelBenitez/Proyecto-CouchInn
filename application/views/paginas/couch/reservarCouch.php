<?php echo form_open('/index.php/couch/reservarCouch/'.$couch->id_couch); ?>



<div class="container" style="">
	<div class="form-group col-md-offset-3 col-md-6">
		<h2>Reservar:</h2>
		<h3><?php echo $couch->titulo ?></h3>
		<br>
		
		<p>Por favor, ingrese el rango de fechas en el que desea hospedar el couch: </p>

		<!--Fecha de inicio de la reserva -->

		<label for="fecha_inicio"> Fecha de inicio: </label>
		<input type="date" name="fecha_inicio" value="<?php if(isset($_POST['fecha_inicio'])) echo $_POST['fecha_inicio']; ?>" class="form-control" step="1" min="<?php echo date('Y-m-d'); ?>" max="2020-12-31" />
		
			<?php if(!empty(form_error('fecha_inicio'))){
				echo '<div class="alert alert-danger">';
				echo form_error('fecha_inicio');
				echo '</div>';
			}
			?>
		<br>
		
		<!-- Fecha de fin de la reserva -->

		<label for="fecha_fin"> Fecha de fin: </label>
		<input type="date" name="fecha_fin" value="<?php if(isset($_POST['fecha_fin'])) echo $_POST['fecha_fin']; ?>" class="form-control" step="1" min="<?php echo date('Y-m-d'); ?>" max="2020-12-31" />
		
			<?php if(!empty(form_error('fecha_fin'))){
				echo '<div class="alert alert-danger">';
				echo form_error('fecha_fin');
				echo '</div>';
			}
			?>
		<br>
		
		<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $couch->id_couch; ?>" >
		<?php if(!empty(form_error('id_couch'))){
				echo '<div class="alert alert-danger">';
				echo form_error('id_couch');
				echo '</div>';
			}
			?>
		<input type="submit" value="Reservar" class="btn btn-default">
		</form>
		
		<!--Volver a la descripcion del couch que quiero reservar -->
		<?php $atributtes = array('style' => 'float:right'); ?>
		<?php echo form_open('/index.php/couch/descripcion',$atributtes); ?>
			<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $couch->id_couch; ?>">
			<input type="submit" value="Volver" class="btn btn-default">
		</form>

		<br><br>
		
		<!-- Acá muestro todas las reservas aceptadas que tiene un couch, para que el usuario sepa que hay disponible -->
		<div class="panel panel-default ">
		<div class="panel-heading">Reservas realizadas a este couch</div>
			<div class="panel-body">
				<ul class="list-group">
					<?php foreach ($reservas as $key => $reserva) {
						echo '<li class="list-group-item"> <b>'.($key+1).' - </b> De '.$reserva->fecha_inicio.' hasta '.$reserva->fecha_fin.' </li>';
					} ?>
				</ul>
			</div>
		</div>


	</div>
</div>