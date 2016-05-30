<?php echo form_open('/index.php/sesiones/registrarse'); ?>

<div class="container" style="">
	<div class="form-group col-md-offset-4 col-md-4">

		<!-- EMAIL -->
		<label for="email"> Email: </label>
		<input type="text" name="email" value="" class="form-control" placeholder="Ej: nombre@mail.com, (con este email usted iniciará sesión en el sistema)" size="50" maxlength="70" />
		
			<?php if(!empty(form_error('email'))){
				echo '<div class="alert alert-danger">';
				echo form_error('email');
				echo '</div>';
			}
			?>
		<br>

		<!-- NOMBRE -->
		<label for="nombre"> Nombre: </label>
		<input type="text" name="nombre" value="" class="form-control" placeholder="Nombre del usuario, (solo letras)" size="50" maxlength="50" />
		
			<?php if(!empty(form_error('nombre'))){
				echo '<div class="alert alert-danger">';
				echo form_error('nombre');
				echo '</div>';
			}
			?>
		<br>

		<!-- APELLIDO -->
		<label for="apellido"> Apellido: </label>
		<input type="text" name="apellido" value="" class="form-control" placeholder="Apellido del usuario, (solo letras)" size="50" maxlength="50" />
		
			<?php if(!empty(form_error('apellido'))){
				echo '<div class="alert alert-danger">';
				echo form_error('apellido');
				echo '</div>';
			}
			?>
		<br>

		<!-- FECHA DE NACIMIENTO -->	
		<label for="fecha_nac"> Fecha de Nacimiento: </label>
		<input type="date" name="fecha_nac" step="1" min="1900-01-01" max="<?php echo date("Y-m-d");?>" class="form-control">	
			
			<?php if(!empty(form_error('fecha_nac'))){
					echo '<div class="alert alert-danger">';
					echo form_error('fecha_nac');
					echo '</div>';
				}
				?>
		<br>

		<!-- TELEFONO -->
		<label for="telefono"> Numero de Teléfono: </label>
		<input type="tel" name="telefono" class="form-control" placeholder="Numero de telefono (Minimo 7 numeros)" size="50" maxlength="20">

			<?php if(!empty(form_error('telefono'))){
						echo '<div class="alert alert-danger">';
						echo form_error('telefono');
						echo '</div>';
					}
					?>
		<br>

		<!-- CONTRASEÑA -->
		<label for="passw"> Contraseña: </label>
		<input type="password" name="passw" value="" class="form-control" placeholder="Minimo 5 caracteres, letras y/o números" size="50" maxlength="10" />
		
			<?php if(!empty(form_error('passw'))){
				echo '<div class="alert alert-danger">';
				echo form_error('passw');
				echo '</div>';
			}
			?>
		<br>

		<!-- CONFIRMACION DE CONTRASEÑA -->
		<label for="passwconf"> Confirmar Contraseña: </label>
		<input type="password" name="passwconf" value="" class="form-control" placeholder="Repetir la contraseña ingresada arriba" size="50" maxlength="10" />
		
			<?php if(!empty(form_error('passwconf'))){
				echo '<div class="alert alert-danger">';
				echo form_error('passwconf');
				echo '</div>';
			}
			?>
		<br>

		<!-- BOTON A PREMIUM -->
		<div class="checkbox">
  			<label><input type="checkbox" name="tipo" value="premium"> Adquirir servicio premium </label>
  			<br> <br>
  			<p> (Requiere de un pago único con tarjeta de crédito al que se le redireccionará luego de registarse).</p>
		</div>

		<!-- BOTON SUBMIT -->
		<div>
			<input type="submit" value="Enviar" class="btn btn-default"/>
		</div>

	</div>
</div>

</form>