<?php echo form_open('/index.php/tipos/agregarTipo'); ?>

<div class="container" style="">
	<div class="form-group">
		<h2>Agregar un nuevo tipo de hospedaje</h2>
		<br>
		<label for="tipo"> Tipo: </label>
		<input type="text" name="tipo" value="" class="form-control" placeholder="Solo caracteres alfabéticos, sin espacios" size="50" maxlength="20" />
		
			<?php if(!empty(form_error('tipo'))){
				echo '<div class="alert alert-danger">';
				echo form_error('tipo');
				echo '</div>';
			}
			?>
	</div>
	<div>
		<input type="submit" value="Enviar" class="btn btn-default"/>
	</div>
</div>


</form>