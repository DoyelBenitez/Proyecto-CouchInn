<br>
<div class="container">
<div class="panel panel-default col-md-offset-2 col-md-8">
	<div class="panel-heading">Comentarios</div>
	<div class="panel-body">
		<?php ;
		    $reverse = array_reverse($comentarios); ?>
			<br>
			<?php
			$limite = 10;	  
			if($estado == "TRUE"){
			 $limite = 99999;
			}
			$contador = 0;
			 ?>
		<?php foreach ($reverse as $comentario) 
		{ ?>
				<?php 
					if ($contador == $limite){
						break;
					}
					$nombreUsuario = $this->sesiones_model->getUserById($comentario->id_usuario);
					$nombreUsuario = reset($nombreUsuario)->nombre;
				?>
		 		<h4> <u> <?php echo $nombreUsuario.':'; ?> </u> </h4>
		 		<blockquote><b> <?php echo $comentario->comentario ?> </b> </blockquote>
		 	
		 		<?php
		 			$respuesta = $comentario->respuesta;
		 			if (!empty($respuesta))
		 			{   // me quedo con el nombre del usuario del couch
		 				$datosCouch = $this->couchs_model->getCouch($comentario->id_couch);
		 				$userNomCouch = $this->sesiones_model->getUserById(reset($datosCouch)->id_usuario);
		 				$userNomCouch = reset($userNomCouch)->nombre;
		 				?>
		 						 				
		 			    <blockquote><u><h4> <?php echo $userNomCouch ?> Respondio: </h4></u>
		 				<b> <?php echo $comentario->respuesta ?></b> </blockquote>

		 		<?php	} 
		 			else 
		 			{ 	?>

				<?php 
						//me quedo con los datos del que esta logeado 
						$aux = $this->session->userdata() ;
						$usuarioTipo = $this->session->userdata('tipo');		
					?>
						
				<?php	
					//controlo que este logeado y no sea admin
						if ((count($aux) > 1) & ($usuarioTipo != 'admin') ) 
						{ ?> 
						
						<?php  	
							//Me quedo con el tipo y el nombre de usuario que esta logueado
							//me quedo con el email para poder averiguar el id del usuario (el userdata no lo te muestra)
							$userEmail = $this->session->userdata('email');
							$user_allDatos = $this->sesiones_model->getUserByEmail($userEmail);
							$userId_logeado = reset($user_allDatos)->id_usuario;
							$userId_couch =$couch->id_usuario; 
							
							if($userId_logeado == $userId_couch) // si el usuario que esta logeado es el mismo que el del couch then
							{ ?>
								<div class="panel-body">
						 		<div class="container" style="">
						 		<?php echo form_open('/index.php/couch/responderComentario'); // por cada boton responder habro un formulario nuevo  ?>
								<textarea name='respuesta' rows="2" cols="50" maxlength="350" > </textarea>
								<div class="container" style="">
								<div class="panel-body"></div>
								</div>
								<input type="submit" value="Responder" class="btn btn-default" style="text-align:center"/>
								<input type="hidden" size="15" maxlength="30" value="<?php echo $comentario->id_comentario; ?>" name="id_comentario">
								<input type="hidden" size="15" maxlength="30" value="<?php echo $id_couch ?>" name="id_couch">
								</form> <?php //fin del formulario ?>

		 						</div></div>
										
					<?php	} ?>
				<?php	} ?>
		

			<?php	} ?>	
		 		<br><br>
			
		<?php $contador = $contador + 1;
		 } ?>
	</div>	
</div>
</div>
<br>

<?php 
	$estaLog = $this->session->userData('tipo'); 
	if (!empty($estaLog)) // verifico que este logeado para mostrar el boton.
	{
		if($estado == "FALSE") // verifico que no se haya apretado ya.
		{
			echo form_open('/index.php/couch/Descripcion'); //BOTON que se encarga de mostrarte los comentarios que faltan ?>
			<div class="text-center">
			<input type="hidden" size="15" maxlength="30" value="<?php echo $id_couch; ?>" name="id_couch">
			<input name="booleano" type="hidden" size="15" maxlength="30" value="TRUE" />
			<input type="submit" value="Ver mas comentarios" class="btn btn-default "/>
			</div>
			</form>
			</form>
<?php }		
 		 } ?>

