<div class="container">
	<ul class="col-lg-offset-3 col-lg-6 list-group">
		<?php foreach ($couchs as $couch) { ?>
			<li class="row list-group-item">
				
				<!-- Título del couch -->
				<h2><?php echo $couch->titulo ?></h2>
				
				<!--Hago un formulario para que la imagen del couch funcione como un botón -->
				<form method="post" action="<?php echo site_url('index.php/couch/descripcion/'); ?>">
					
					<!-- Imagen como botón que redigire al controlador Descripcion -->
					<input type= "image" src=<?php echo $couch->imagen; ?> class="btn btn-default" style="height:400px;width:500px" alt="Submit Form">
					
					<!-- Input oculto del id del couch para mandarselo al controlador en forma de $POST_['id_couch'] -->
					<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $couch->id_couch; ?>">
				</form>

			</li>
		<?php } 
		?>	
	</ul>
</div>