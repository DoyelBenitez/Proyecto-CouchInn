


<div class="container" style="text-align center">
	<div class="">
		<br>
		<div class="text-center">
		<h1> <?php echo $title; ?> </h1></div>
		<br>
			 <?php foreach ($couchs as $couch) { ?>
			 	<?php   
   						 $usuario= $this->couchs_model->getUserNom($couch->id_usuario);
    					 $usuario = reset($usuario)->nombre;

					?>
			 <div class="text-center">	
			 	<p> <?php echo $couch->descripcion ?>.</p>
			 	
			 
					<li> Puntaje promedio: <?php echo $couch->Porcentaje ?>.</li>
					<li> Capacidad: <?php echo $couch->capacidad ?> persona/s.</li>
					<?php
						$tipo= $this->couchs_model->getTipoOfCouch($couch->id_tipo);
    					
    					
      					?>

      				 <?php foreach ($tipo as $lop) {		;?>

      					<?php if ($lop->id_tipo == $couch->id_tipo){ ?>
						<li>De tipo:  <?php echo $lop->tipo ?></li>

					<?php } ?>

					<?php } ?>
				</div>
			<?php } ?>
			
			 <div class="text-center">	
			<h3>Publico <?php echo $usuario?></h3>
			</div>
	</div>
</div>
