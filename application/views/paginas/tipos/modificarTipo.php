<?php echo form_open('/index.php/tipos/modificarTipo'); ?>

<div class="container" style="text-align:center">
	<div class="form-group col-md-offset-4 col-md-4">
		<h2>Nombre de tipo nuevo: </h2>
		<input type="text" name="tipo" value="" placeholder="Solo caracteres alfabéticos, sin espacios" size="50" maxlength="20" />
		
			<?php if(!empty(form_error('tipo'))){
				echo '<div class="alert alert-danger">';
				echo form_error('tipo');
				echo '</div>';
			}
			?>
		<!-- 	Este input oculto es el que guarda el tipoViejo a modificar para despues tenerlo en el controlador 
				cuando vuelva de la validacion y esta vista -->
		<input type="hidden" name="tipoViejo" value="<?php echo $tipoViejo; ?>" />
		<br><br>
		<input type="submit" value="Enviar" class="btn btn-default"/>
	</div>
</div>


</form>