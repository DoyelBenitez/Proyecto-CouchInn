<br>
<div class="container" style="text-align center">
<div class="panel panel-default col-md-offset-2 col-md-8">
	<div class="panel-heading">Detalles</div>
	<div class="panel-body">	
		<br>
		<div class="text-center">
		<h1> <?php echo $title; ?> </h1></div>
		<br>
			 <div class="text-center">	
			 	<p> <?php echo $couch->descripcion ?>.</p>
			 	
			 
					<li> Puntaje promedio: 
						<?php 
							if(!empty($promedio)){
								echo $promedio; ?>
							<a href="<?php echo site_url('index.php/couch/verPuntajesCouch').'/'.$id_couch; ?>">
								¡Ver todos los puntajes!
							</a>
						<?php 
							}
							else echo 'n/a'; 
						?>
					</li>
					<li> Capacidad: <?php echo $couch->capacidad ?> persona/s.</li>
					<li> Localidad: <?php echo $couch->localidad ?> </li>
					<?php
						$tipo= $this->couchs_model->getTipoOfCouch($couch->id_tipo);
    					$tipo = reset($tipo)->tipo	
      				?>

						<li>De Tipo:  <?php echo $tipo ?> </li>


				</div>
			
			<div class="text-center">	
				<h3>Publicado por: <?php echo $usuario->nombre?></h3>
				<?php 
					$usuarioLogueado = $this->session->userdata('email');
					if ($usuarioLogueado != $usuario->email) { ?>
						<!-- Botón para ver perfil del dueño -->
						<form method="post" action="<?php echo site_url('index.php/verUsuario').'/'.$usuario->id_usuario; ?>">
							<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $id_couch ?>">
							<input type="submit" class="btn btn-default" value="Ver Usuario">
						</form>
				<?php 
					} ?>
			</div>
	</div>
</div>
</div>
