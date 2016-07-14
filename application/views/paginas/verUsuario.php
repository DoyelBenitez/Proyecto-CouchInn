<div class="container" style="text-align center">

	<!-- Botón para volver a las reservas del couch -->
	<form method="post" style="text-align:center" action="<?php echo site_url('index.php/couch/descripcion'); ?>">
		<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $id_couch ?>">
		<input type="submit" class="btn btn-default" value="Volver atrás">
	</form>
	<br>

<div class="panel panel-default col-md-offset-2 col-md-8">
	<div class="panel-heading">Datos del usuario</div>
	<div class="panel-body">
		<h4><b>Email: </b><?php echo $usuario->email ?></h4>
		<h4><b>Nombre: </b><?php echo $usuario->nombre ?></h4>
		<h4><b>Apellido: </b><?php echo $usuario->apellido ?></h4>
		<h4><b>Teléfono: </b><?php echo $usuario->telefono ?></h4>
		<h4><b>Puntaje Promedio: </b><?php echo $puntajePromedio ?></h4>
	</div>

	<br><br>

	<div class="panel-heading">Puntajes y comentarios al usuario</div>
	<div class="panel-body">
		<ul class="list-group">
		<?php 
			foreach ($puntajes as $key => $puntaje) { ?>
				<li class="list-group-item">
				<h5><b>De: </b><?php echo $puntaje->email ?></h5>
				<p><b>Puntaje: </b><?php echo $puntaje->puntaje ?></p>
				<p><b>Comentario: </b><?php echo $puntaje->comentario ?></p>
				</li>
		<?php } ?>
		</ul>
	</div>
</div>
</div>