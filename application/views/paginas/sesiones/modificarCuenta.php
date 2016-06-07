<?php $usuario = $this->session->userdata(); ?>
<?php echo form_open('/index.php/sesiones/modificarCuenta'); ?>

<div class="container" style="">
	<div class="form-group col-md-offset-4 col-md-4">

		<h3>Modificar datos de su cuenta: </h3>

		<!-- NOMBRE -->
		<label for="nombre"> Nombre: (actual:<?php echo $usuario['nombre']; ?>)</label>
		<input type="text" name="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>" class="form-control" placeholder="Nombre del usuario, (solo letras)" size="50" maxlength="50" />
		
			<?php if(!empty(form_error('nombre'))){
				echo '<div class="alert alert-danger">';
				echo form_error('nombre');
				echo '</div>';
			}
			?>
		<br>

		<!-- APELLIDO -->
		<label for="apellido"> Apellido: (actual:<?php echo $usuario['apellido']; ?>) </label>
		<input type="text" name="apellido" value="<?php if(isset($_POST['apellido'])) echo $_POST['apellido']; ?>" class="form-control" placeholder="Apellido del usuario, (solo letras)" size="50" maxlength="50" />
		
			<?php if(!empty(form_error('apellido'))){
				echo '<div class="alert alert-danger">';
				echo form_error('apellido');
				echo '</div>';
			}
			?>
		<br>

		<!-- FECHA DE NACIMIENTO -->	
		<label for="fecha_nac"> Fecha de Nacimiento: (actual:<?php echo $usuario['fecha_nacimiento']; ?>) </label>
		<input type="date" name="fecha_nac" value="<?php if(isset($_POST['fecha_nac'])) echo $_POST['fecha_nac']; ?>" step="1" min="1900-01-01" max="<?php echo date("Y-m-d");?>" class="form-control">	
			
			<?php if(!empty(form_error('fecha_nac'))){
					echo '<div class="alert alert-danger">';
					echo form_error('fecha_nac');
					echo '</div>';
				}
				?>
		<br>

		<!-- TELEFONO -->
		<label for="telefono"> Numero de Teléfono: (actual:<?php echo $usuario['telefono']; ?>) </label>
		<input type="tel" name="telefono" value="<?php if(isset($_POST['telefono'])) echo $_POST['telefono']; ?>" class="form-control" placeholder="Numero de telefono (Minimo 7 numeros)" size="50" maxlength="20">

			<?php if(!empty(form_error('telefono'))){
						echo '<div class="alert alert-danger">';
						echo form_error('telefono');
						echo '</div>';
					}
					?>
		<br>

		<!-- CONTRASEÑA -->
		<label for="passw"> Contraseña: </label>
		<input type="password" name="passw" class="form-control" placeholder="Minimo 5 caracteres, letras y/o números" size="50" maxlength="10" />
		
			<?php if(!empty(form_error('passw'))){
				echo '<div class="alert alert-danger">';
				echo form_error('passw');
				echo '</div>';
			}
			?>
		<br>

		<!-- CONFIRMACION DE CONTRASEÑA -->
		<label for="passwconf"> Confirmar Contraseña: </label>
		<input type="password" name="passwconf" class="form-control" placeholder="Repetir la contraseña ingresada arriba" size="50" maxlength="10" />
		
			<?php if(!empty(form_error('passwconf'))){
				echo '<div class="alert alert-danger">';
				echo form_error('passwconf');
				echo '</div>';
			}
			?>
		<br>

		<!-- BOTON SUBMIT -->
		<div>
			<input type="submit" value="Enviar" class="btn btn-default"/>
		</div>

	</div>
</div>

</form>