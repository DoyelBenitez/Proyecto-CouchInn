<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo $title ?> </title>
	<link href="<?php echo site_url('/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
</head>
<body>
	<?php 
		//Me quedo con el tipo y el nombre de usuario que esta logueado
		$usuarioTipo = $this->session->userdata('tipo');
		$usuarioNombre = $this->session->userdata('nombre');
	 ?>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="<?php echo site_url(); ?>" >
					<img alt="Brand" src="<?php echo site_url('imagenes/logoChico.png'); ?>" width="28" height="25">
				</a>

			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="navbar-collapse collapse">
		
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="hidden" class="form-control" placeholder="Busqueda...">
					</div>
				<!--	<button type="submit" class="btn btn-default">Buscar</button>-->
				</form>
				<ul class="nav navbar-nav navbar-right">
					<?php

						if(!empty($usuarioTipo))
						{
							echo '<li><a href="'.site_url('index.php/sesiones/cerrarSesion').'">Cerrar Sesión ('.$usuarioNombre.')</a></li>';
						}
						else
						{
							echo '<li><a href="'.site_url('index.php/sesiones/iniciarSesion').'">Iniciar Sesión</a></li>';
							echo '<li><a href="'.site_url('index.php/sesiones/registrarse').'">Registrarse</a></li>';
						}
					?>

					<!-- Dropdown de datos del usuario logueado-->

					<?php
					//Si está logueado
					if (!empty($usuarioTipo)) {
						
						echo '<li class="dropdown">';
							echo '<a href="#" data-toggle="dropdown" class="dropdown-toggle">Usuario';
							if(!empty($usuarioTipo)){
								echo '('.$usuarioTipo.')'; echo '<b class="caret"></b></a>';
							} 
							echo '<ul class="dropdown-menu">';
						 ?>   
							<!-- Opciones de todos -->
							<?php 
								if (!empty($usuarioTipo)) {
									echo '<li class="dropdown-header">Cuenta</li>';
									echo '<li><a href="'.site_url('index.php/sesiones/modificarCuenta').'"> Modificar datos de cuenta </a></li>';
								}
							 ?> 
							
							<!-- Separador para opciones de usuarios especificos -->
							<li role="separator" class="divider"></li>

							<!-- Opciones del admin -->
							<?php 
								if ($usuarioTipo == 'admin') {
									echo '<li class="dropdown-header">Admin</li>';
									echo '<li><a href="'.site_url('index.php/tipos/listarTipos').'">Ver tipos de hospedaje</a></li>';
								/*	echo '<li><a href="#">Eliminar usuario</a></li>'; */
								}
							?> 

							<!-- Opciones premium o comun (Para couchs)-->
							<?php 
								if (($usuarioTipo == 'comun') or ($usuarioTipo == 'premium')) {
									echo '<li class="dropdown-header">Couchs</li>';
									echo '<li> <a href= "'.site_url('index.php/couch/agregarCouch').'"> Agregar un Couch</a></li>';
									echo '<li> <a href= "'.site_url('index.php/couch/listarCouchsDeUsuario').'"> Mis Couchs</a></li>';
								}
							 ?>

							<!-- Opciones del usuario comun -->
							<?php 
								if ($usuarioTipo == 'comun') {
									echo '<li class="dropdown-header">Premium</li>';
									echo '<li><a href="'.site_url('index.php/sesiones/comprarPremium').'"> Pasarse a PREMIUM</a></li>';
								}
							   

							echo '</ul>';
						echo '</li>';
					}
					?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	
	<div style="text-align:center">
		<br><br>	
		
		<!-- Imagen Grande de logo -->
		<a href="<?php echo site_url(); ?>">
		<p style="text-align=center;"><img src="<?php echo site_url('imagenes/logo.png'); ?>" width="800" height="200" ></p>
		</a>
		

		<!-- Boton para ir atras: -->

		<?php
		
		 /*
			$currentURL = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
>>>>>>> origin/codigo
			if ( $currentURL != base_url())
			{
				if(!empty($_SERVER['HTTP_REFERER']))
				{
					$referer = $_SERVER['HTTP_REFERER'];
					echo '<a href="'.$referer.'" style= "text-align:center" class="btn btn-default"> Ir atrás </a>';
				}
			}*/
		?>


	</div>