<?php echo form_open('/index.php/sesiones/iniciarSesion'); ?>

<div class="container" style="">
	<div class="form-group">
		<h2>Iniciar Sesión</h2>
		<br>
		
		<label for="email"> Email: </label>
		<input type="text" name="email" value="" class="form-control" placeholder="Ej: nombre@mail.com" size="50" maxlength="70" />
		
			<?php if(!empty(form_error('email'))){
				echo '<div class="alert alert-danger">';
				echo form_error('email');
				echo '</div>';
			}
			?>

		<label for="passw"> Contraseña: </label>
		<input type="password" name="passw" value="" class="form-control" placeholder="Minimo 5 caracteres, letras y/o números" size="50" maxlength="10" />
		
			<?php if(!empty(form_error('passw'))){
				echo '<div class="alert alert-danger">';
				echo form_error('passw');
				echo '</div>';
			}
			?>
	</div>

	<div>
		<input type="submit" value="Enviar" class="btn btn-default"/>
	</div>
</div>


</form>