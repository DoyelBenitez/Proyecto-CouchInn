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
		<?php foreach ($reverse as $comentario) { ?>
				<?php 
					if ($contador == $limite){
						break;
					}
					$nombreUsuario = $this->sesiones_model->getUserByIdParaCouch($comentario->id_usuario);
					$nombreUsuario = reset($nombreUsuario)->nombre;
				?>
		 		<h4> <u> <?php echo $nombreUsuario.':'; ?> </u> </h4>
		 		<blockquote><b> <?php echo $comentario->comentario ?> </b>
		 	
		 		<?php
		 			$respuesta = $comentario->respuesta;
		 			if (!empty($respuesta))
		 			{   // me quedo con el nombre del usuario del couch
		 				$datosCouch = $this->couchs_model->getCouch($comentario->id_couch);
		 				$userNomCouch = $this->sesiones_model->getUserById(reset($datosCouch)->id_usuario);
		 				$userNomCouch = reset($userNomCouch)->nombre;
		 				?>
		 				<blockquote>
		 				<u><h4> <?php echo $userNomCouch ?> dijo: </h4></u>
		 				<b> <?php echo $comentario->respuesta ?></b> </blockquote>

		 		<?php	}  
		 		?>
		 		</blockquote>

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

