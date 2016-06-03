

<div class="container" style="text-align center">
	<div class="form-group col-md-offset-4 col-md-8">
		<br>
		<h1> <?php echo $title; ?> </h1>
		<br>
			 <?php foreach ($couchs as $couch) { ?>
			 	
			 	<p> <?php echo $couch->descripcion ?>.</p>
			 	
			 	<ul class="list group">	
					<li> Puntaje promedio: <?php echo $couch->Porcentaje ?>.</li>
					<li> Capacidad: <?php echo $couch->capacidad ?> persona/s.</li>
				 </ul>
			<?php } ?>
	</div>
</div>
