<?php echo form_open('/index.php/reservas/puntuarCouch'); ?>

<div class="container" style="">
	<div class="form-group col-md-offset-4 col-md-4">
		<h2>Puntuar un couch</h2>
		<br>

		<!-- Mando como ocultos el id_usuario y el id_couch -->
		<input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
		<input type="hidden" name="id_couch" value="<?php echo $id_couch; ?>">

		<!-- Esto es para decirle al error que ya entro una vez a la vista, para que no muestre errores la primera vez que entra -->
		<input type="hidden" name="entro" value="TRUE">

		<!--Puntaje -->
		<label for="puntaje"> Puntaje (entre 1 y 5): </label>
		<input type="number" name="puntaje" value="<?php if(isset($_POST['puntaje'])) echo $_POST['puntaje']; ?>" class="form-control" placeholder="Entre 1 y 5" min="1" max="5" size="50" maxlength="70" />
		
			<?php if(!empty(form_error('puntaje') and ($mostrarError))){
				echo '<div class="alert alert-danger">';
				echo form_error('puntaje');
				echo '</div>';
			}
			?>
		<br>
		<input type="submit" value="Puntuar" class="btn btn-default "/>
		</form>
		
		<!--Boton para volver a reservas -->
		<?php $atributtes = array('style' => 'float:right'); ?>
		<?php echo form_open('/index.php/reservas/verMisReservas',$atributtes); ?>
			<input type="submit" class="btn btn-default" value="Volver" >
		</form>
	</div>
</div>
