

<div class="container" style="text-align center">
	<div class="">
		<br>
		<div class="text-center">
		<h1> <?php echo $title; ?> </h1></div>
		<br>
			 <?php foreach ($couchs as $couch) { ?>
			 <div class="text-center">	
			 	<p> <?php echo $couch->descripcion ?>.</p>
			 	
			 
					<li> Puntaje promedio: <?php echo $couch->Porcentaje ?>.</li>
					<li> Capacidad: <?php echo $couch->capacidad ?> persona/s.</li>
				</div>
			<?php } ?>
	</div>
</div>
