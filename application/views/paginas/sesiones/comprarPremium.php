<?php echo form_open('/index.php/sesiones/comprarPremium'); ?>

<div class="container" style="">
	<div class="form-group col-md-offset-2 col-md-8">
		
		<h2>Adquirir el servicio Premium de CouchInn</h2>
		<br>
		<p> Con este servicio todos los couchs que usted publiquen en la página tendran su imagen correspondiente 
		    en el listado de couchs de la página principal.</p>
		<br>

		<!-- Tipo de tarjeta -->
		<label for="compania">Selccione la compañía de su tarjeta (seleccione una):</label>
		<select class="form-control" name="compania" >
			<option>Visa</option>
			<option>Master Card</option>
			<option>Santander</option>
			<option>BBVA</option>
		</select>
		<br>

		<!-- Número de tarjeta -->
		<label for="tarjeta"> Número de tarjeta: </label>
		<input type="text" name="tarjeta" value="<?php if(isset($_POST['tarjeta'])) echo $_POST['tarjeta']; ?>" class="form-control" placeholder="Número de su tarjeta de crédito, (16 números sin espacios)" size="50" maxlength="16" />
		
			<?php if(!empty(form_error('tarjeta'))){
				echo '<div class="alert alert-danger">';
				echo form_error('tarjeta');
				echo '</div>';
			}
			?>
		<br>

		<!-- Número de seguridad -->
		<label for="pin"> Número de pin de seguridad: </label>
		<input type="text" name="pin" value="<?php if(isset($_POST['pin'])) echo $_POST['pin']; ?>" class="form-control" placeholder="Número de pin de tarjeta de crédito, (3 números sin espacios)" size="50" maxlength="3" />
		
			<?php if(!empty(form_error('pin'))){
				echo '<div class="alert alert-danger">';
				echo form_error('pin');
				echo '</div>';
			}
			?>
		<br>


		<label for="fecha_ven"> Fecha de Vencimiento de la Tarjeta: </label>
		<input type="date" name="fecha_ven" value="<?php if(isset($_POST['fecha_ven'])) echo $_POST['fecha_ven']; ?>" step="1" min="1900-01-01" max="<?php //echo date("Y-m-d");?>" class="form-control">	
			
			<?php if(!empty(form_error('fecha_ven'))){
					echo '<div class="alert alert-danger">';
					echo form_error('fecha_ven');
					echo '</div>';
				}
				?>
		<br>

		<input type="submit" value="Enviar" class="btn btn-default "/>
	</div>
</div>


</form>