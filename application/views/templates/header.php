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
				<ul class="nav navbar-nav">
					
					<!-- Current link (no creo que lo usemos)
					<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
					<li><a href="#">Link</a></li>}
					-->

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Datos <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="dropdown-header"> Admin </li>
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
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
							echo '<li><a href="'.site_url('index.php/sesiones/registrarse').'">Registarse</a></li>';
						}
					?>
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">Dropdown <b class="caret"></b></a>
				        <ul class="dropdown-menu">
				            <li><a href="#">Action</a></li>
				            <li><a href="#">Another action</a></li>
				        </ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	
	<div style="text-align:center">
		<br><br>	
		
		<!-- Imagen Grande de logo -->
		<p style="text-align=center;"><img src="<?php echo site_url('imagenes/logo.png'); ?>" width="800" height="200" ></p>
		<h1><?php echo $page_header; ?></h1>
		

		<!-- Boton para ir atras: -->
		<?php
			$currentURL = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			if ( $currentURL != base_url())
			{
				if(!empty($_SERVER['HTTP_REFERER']))
				{
					$referer = $_SERVER['HTTP_REFERER'];
					echo '<a href="'.$referer.'" style= "text-align:center" class="btn btn-default"> Ir atrás </a>';
				}
			}
		?>
	</div>