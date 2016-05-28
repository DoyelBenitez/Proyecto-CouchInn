<?php echo form_open('/index.php/tipos/modificarTipo'); ?>

<div class="container" style="text-align:center">
	<div class="form-group">
		<h2>Nombre de tipo nuevo: </h2>
		<input type="text" name="tipo" value="" placeholder="Solo caracteres alfabéticos, sin espacios" size="50" maxlength="20" />
		
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