<?php echo form_open('/index.php/couch/responderComentario'); ?>
<link href="<?php echo site_url('/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
<div style="text-align:center">
		<br><br>	
		
		<!-- Imagen Grande de logo 
		<a href="<?php echo site_url(); ?>">
		<p style="text-align=center;"><img src="<?php echo site_url('imagenes/logo.png'); ?>" width="800" height="200" ></p>
		</a> -->
	</div>
<br>

<div> <?php // Lo muestro aca xq si no se repite en todos los campos 
		 if (validation_errors()): 
   			echo '<div class="alert alert-danger">'?>
   		    <?php echo validation_errors(); ?>
  			</div>
			<?php endif; ?>
</div>

<div class="container">
<div class="panel panel-default col-md-offset-2 col-md-8">
	<?php
	$mailUserLog = $this->session->userdata('email');
	$idUserLog = $this->sesiones_model->getUserByEmail($mailUserLog);
	$idUserLog = reset($idUserLog)->id_usuario; // aca me quede con el id del user logeado
	$couchsUserLog = $this->couchs_model->getCouchsById_user($idUserLog);//me quedo con sus couchs
	if (empty($couchsUserLog)) {
		echo '<p style="text-align:center"> No tiene ningún mensaje sin responder </p>';
	}
	foreach ($couchsUserLog as $couch){ //recorro todos los couchs del usuario 
		$titulo =$couch->titulo;	
	?>
	<div class="panel-heading"><li>Mensajes del couch:  <?php echo $titulo ?> </li></div>
	<div class="panel-body">	
		<blockquote> 
			<?php
			$id_couch = $couch->id_couch;
			$allMenSinR = $this->couchs_model->getComentariosSinResponderById_couch($id_couch); //me quedo con los couchs 

			foreach ($allMenSinR as $mensajeCouch) { //por cada couch muestro todos sus comentarios sin responder + boton
				$idUserMensaje = $mensajeCouch->id_usuario;
				$nomUserMensaje = $this->sesiones_model->getUserById($idUserMensaje);
				$nomUserMensaje = reset($nomUserMensaje)->nombre; // me quedo con el nombre del usuario del mensaje
				?>

			<div class="panel-heading"><li>Mensaje del Usuario:  <?php echo $nomUserMensaje ?> </li></div>
			<div class="panel-body">
				<blockquote><?php	print_r($mensajeCouch->comentario) ?></blockquote>
					<div class="container" style="">

				<br> <?php // espacion el blanco ?>

				<?php echo form_open('/index.php/couch/responderComentario'); // por cada boton responder habro un formulario nuevo  ?>
				<textarea name='respuesta' rows="2" cols="50" maxlength="350" > </textarea>
				<div class="container" style="">
				<div class="panel-body">
									</div>
					</div>
			

				<input type="submit" value="Responder" class="btn btn-default" style="text-align:center"/>
				<input type="hidden" size="15" maxlength="30" value="<?php echo $mensajeCouch->id_comentario; ?>" name="id_comentario">
				</form> <?php //fin del formulario ?>		
					</div>
			</div>

	<?php  } ?>
			

	</div>	

	<?php } ?>
</div>
</div>
<br>