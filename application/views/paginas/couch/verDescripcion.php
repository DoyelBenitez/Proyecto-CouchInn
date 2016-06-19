
<br>

<div class="container" style="text-align center">
<div class="panel panel-default col-md-offset-2 col-md-8">
	<div class="panel-heading">Detalles</div>
	<div class="panel-body">	
		<br>
		<div class="text-center">
		<h1> <?php echo $title; ?> </h1></div>
		<br>
			 <?php
			 	//Me quedo con el nombre del usuario
			 	$usuario = $usuario->nombre
    			
			 ?>
			 <div class="text-center">	
			 	<p> <?php echo $couch->descripcion ?>.</p>
			 	
			 
					<li> Puntaje promedio: <?php //ACA HAY QUE CALCULAR PORCENTAJE ?>.</li>
					<li> Capacidad: <?php echo $couch->capacidad ?> persona/s.</li>
					<li> Localidad: <?php echo $couch->localidad ?> </li>
					<?php
						$tipo= $this->couchs_model->getTipoOfCouch($couch->id_tipo);
    					$tipo = reset($tipo)->tipo	
      				?>

						<li>De Tipo:  <?php echo $tipo ?> </li>


				</div>
			
			<div class="text-center">	
				<h3>Publicado por: <?php echo $usuario?></h3>
			</div>
	</div>
</div>
</div>
