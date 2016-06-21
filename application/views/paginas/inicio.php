




<div class="container " >
	<ul class=" col-lg-offset-3 centro col-lg-6 ">

     
		<?php foreach ($couchs as $couch) { ?>

			<li class="row list-group-item">
				<div class= " list group text-center">
				<!-- Título del couch -->
				<l1><h2><?php echo $couch->titulo ?></h2> </l1> </div>
				
				<!--Hago un formulario para que la imagen del couch funcione como un botón -->
				<form method="post" action="<?php echo site_url('index.php/couch/descripcion/'); ?>">
					
					<!-- Imagen como botón que redigire al controlador Descripcion -->
					<div class="centro">
					<span style="margin:50%;">
					<?php   
   						 $usuario= $this->sesiones_model->getUserById($couch->id_usuario);
   						 
    					 $usuario = reset($usuario)->tipo;
     					 
					?>
					<?php if ($usuario == "premium" or $usuario == "admin"){?>
					<input type= "image" src=<?php echo $couch->imagen; ?> class="img-circle  center-block" style="height:400px;width:500px"  alt="Submit Form" VSPACE="10"></div> </span>
					<?php
						}
					else
					{?>
						<input type= "image" src=<?php echo site_url('imagenes/logoChico.png'); ?> class="img-circle  center-block" style="height:400px;width:500px"  alt="Submit Form" VSPACE="10"></div> </span>
					<?php	} ?>
					
					<!-- Input oculto del id del couch para mandarselo al controlador en forma de $POST_['id_couch'] -->
					<input type="hidden" name="id_couch" id="id_couch" value="<?php echo $couch->id_couch; ?>">
				</form>
				

			</li>
		<?php } 
		?>	
	</ul>
</div>
