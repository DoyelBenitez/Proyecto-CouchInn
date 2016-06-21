
<div class="container">
	<div class="  form-horizontal">

		<?php 
		foreach ($imagenes as $imagen) { 

				echo '<img src=" '. site_url($imagen->imagen).' " align="left" alt="imagen"  style="height:300px;width:300px" HSPACE="40" class="img-rounded" VSPACE="30" >';
		} ?>
	</div>
</div>

<?php 
		$aux = $this->session->userdata() ;
		$usuarioTipo = $this->session->userdata('tipo');

			
	?>
		
<?php	
	
	if ((count($aux) > 1) & ($usuarioTipo != 'admin') ) { ?>
	
	<?php  	
		//Me quedo con el tipo y el nombre de usuario que esta logueado
		$user = $this->session->userdata('email');
		$user = $this->couchs_model->getId($user);
		$user = reset($user)->id_usuario;
		$id_usuario_imagen =$couch->id_usuario; 
		
		if($user == $id_usuario_imagen) { ?>
		
			<div>
			<center><input type="submit" value="Ver_reservas(NO FUNCIONA)" class="btn btn-default"/></center>
			</div>	

<?php	} 
		
		else 
		{ ?>

			<div>
			<center>
			<a href="<?php echo site_url('index.php/couch/reservarCouch/'.$couch->id_couch); ?>">
			<button class="btn btn-default"> Reservar </button>
			</a>
		</center>
			</div>

		<?php 
		} 
		?>

<?php
	} 
?>

	











		



