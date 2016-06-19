<div class="container">
<div class="panel panel-default col-md-offset-2 col-md-8">
	<div class="panel-heading">Comentarios</div>
	<div class="panel-body">	
		<?php foreach ($comentarios as $comentario) { ?>
				<?php 
					$nombreUsuario = $this->sesiones_model->getUserById($comentario->id_usuario);
					$nombreUsuario = reset($nombreUsuario)->nombre;
				?>
		 		<p> <?php echo $nombreUsuario.':'; ?>  </p>
		 		<blockquote><p> <?php echo $comentario->comentario ?> </p>
		 		<input type="submit" value="responder" class="btn btn-default "/>
		 		</blockquote>
		 		<br><br>
			
		<?php } ?>
	</div>	
</div>
</div>
<br>