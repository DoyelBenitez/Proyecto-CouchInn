<div class="container">
	
	<ul class="col-lg-offset-3 col-lg-6 list-group">
	<div class="row">
		<h2 class="col-md-8"> Eliminar Usuario</h2>
	</div>
			<!-- Muestro los usuarios comunes -->
			<h4>Lista de usuarios comunes:</h4>
			<?php  
				if(empty($comunes)){
				  	echo '<p> No hay usuarios comunes en el sistema </p>'; 
				}
				else
				{
			?>

					<form method="post" action="<?php echo site_url('index.php/admin/eliminarUsuario/'); ?>">

					<label for="compania">Seleccione usuario común a eliminar:</label>
					<select class="form-control" name="id_usuarioC" id="id_usuarioC" >
					<?php 
						foreach ($comunes as $key => $comun) { ?>
							<option value="<?php echo $comun->id_usuario ?>" > 
								<?php echo $comun->email ?>
							</option>
					<?php } ?>
					</select>
					<br>

						<input type="submit" onclick="confirmacionEliminar(event)" class="btn btn-default" value="Eliminar">
					</form>
					<br>

			<?php 
				} //del else if(empty($comunes)) 
			?>

			<!-- Muestro los usuarios premium -->
			<h4>Lista de usuarios premium:</h4>
			<?php  
				if(empty($premiums)){
				  	echo '<p> No hay usuarios premium en el sistema </p>'; 
				}
				else
				{
			?>
					<form method="post" action="<?php echo site_url('index.php/admin/eliminarUsuario/'); ?>">

					<label for="compania">Seleccione usuario premium a eliminar:</label>
					<select class="form-control" name="id_usuarioP" id="id_usuarioP" >
					<?php
						foreach ($premiums as $key => $premium) { ?>
							<option value="<?php echo $premium->id_usuario ?>" > 
								<?php echo $premium->email ?>
							</option>
					<?php } ?>
					</select>
					<br>
			
						<input type="submit" onclick="confirmacionEliminar(event)" class="btn btn-default" value="Eliminar">
					</form>

			<?php 
				} //del else if(empty($premiums)) 
			?>

			<script>
			function confirmacionEliminar(event) {
				debugger;
				if(!confirm('¿Seguro que quiere eliminar al usuario?')){
					event.preventDefault();
				}
			}
			</script>	
	</ul>
</div>
