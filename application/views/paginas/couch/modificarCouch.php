<?php echo form_open_multipart('index.php/couch/modificarCouch/'.$couch->id_couch);?>

<div class="container" style="">
	<div class="form-group col-md-offset-2 col-md-8">

		<h2> Modificar datos de un Couch: </h2>
		<br>
		
		<!-- Titulo -->
		<h4><b> Título: </b></h4>		
		<p><?php echo $couch->titulo ?></p>
		<label for="titulo"> Titulo nuevo: </label>
		<input type="text" name="titulo" value="<?php if(isset($_POST['titulo'])) echo $_POST['titulo']; ?>" class="form-control" placeholder="Título del Couch, (Máximo 50 letras)" size="50" maxlength="50">
		
		<?php if(!empty(form_error('titulo'))){
				echo '<div class="alert alert-danger">';
				echo form_error('titulo');
				echo '</div>';
			}
			?>
		<br>
		
		<!-- Descripcion -->
		<h4><b> Descripción: </b></h4>		
		<p>	<?php echo $couch->descripcion ?> </p>
		<label for="descripcion"> Descripcion nueva: </label>
		<input type="text" name="descripcion" value="<?php if(isset($_POST['descripcion'])) echo $_POST['descripcion']; ?>" class="form-control" placeholder="Descripcion del Couch " size="50" maxlength="200">
		
		<?php if(!empty(form_error('descripcion'))){
				echo '<div class="alert alert-danger">';
				echo form_error('descripcion');
				echo '</div>';
			}
			?>
		<br>
		
		<!-- Localidad -->
		<h4><b> Localidad: </b></h4>
		<p>	<?php echo $couch->localidad ?> </p>
		<label for="localidad"> Localidad nueva: </label>
		<input type="text" name="localidad" value="<?php if(isset($_POST['localidad'])) echo $_POST['localidad']; ?>" class="form-control" placeholder="Localidad del couch, ej: La Plata" size="50" maxlength="50">
		
		<?php if(!empty(form_error('localidad'))){
				echo '<div class="alert alert-danger">';
				echo form_error('localidad');
				echo '</div>';
			}
			?>
		<br>

		<!-- Capacidad -->
		<h4><b> Capacidad: </b></h4>
		<p>	<?php echo $couch->capacidad ?> </p>
		<label for="capacidad"> Capacidad nueva (entre 1 y 12): </label>
		<input type="number" name="capacidad" min="1" max="12" value="<?php if(isset($_POST['capacidad'])) echo $_POST['capacidad']; ?>" size="50">
		
		<?php if(!empty(form_error('capacidad'))){
				echo '<div class="alert alert-danger">';
				echo form_error('capacidad');
				echo '</div>';
			}
			?>
		<br><br>

		<!-- Tipo de hospedaje -->
		<h4><b> Tipo de Hospedaje: </b></h4>
		<?php 	$tipo= $this->couchs_model->getTipoOfCouch($couch->id_tipo);
    			$tipo = reset($tipo)->tipo ?>
		<p>	<?php echo $tipo ?> </p>
		<label for="tipo">Tipo de hospedaje nuevo: </label>
		<select class="form-control" name="tipo" id="tipo" >
		<?php 
			foreach ($tipos as $tipo) {
				echo '<option value="'.$tipo->id_tipo.'">'.$tipo->tipo."</option>";
			}
		 ?>
		</select>
		<br>

		<!-- Imagen -->
		<h4><b> Imagen nueva: </b></h4>
		<label for="imagen1" class="control-label"> Imagen principal: </label>
		<p>Esta es la imagen que se verá en el inicio si usted es premium.</p>
		<input type="file" name="imagen1" size="20"/>
		<?php if(!empty(form_error('imagen1'))){
				echo '<div class="alert alert-danger">';
				echo form_error('imagen1');
				echo '</div>';
			}
		?>
		<br>

		<!-- Imagen2 -->
		<label for="imagen2" class="control-label"> 2da Imagen: </label>
		<p>(gif, jpg o png)</p>
		<input type="file" name="imagen2" size="20"/>
		<?php if(!empty(form_error('imagen2'))){
				echo '<div class="alert alert-danger">';
				echo form_error('imagen2');
				echo '</div>';
			}
		?>
		<br>

		<!-- Imagen3 -->
		<label for="imagen3" class="control-label"> 3era Imagen: </label>
		<p>(gif, jpg o png)</p>
		<input type="file" name="imagen3" size="20"/>
		<?php if(!empty(form_error('imagen3'))){
				echo '<div class="alert alert-danger">';
				echo form_error('imagen3');
				echo '</div>';
			}
		?>
		<br>
		
		<!-- Couch original -->
		<?php 
			foreach($couch as $campo)
			{
  				echo '<input type="hidden" name="couch[]" value="'. $campo. '">';
			}
		 ?>

		<input type="submit" value="Enviar" class="btn btn-default" />
	</div>
</div>