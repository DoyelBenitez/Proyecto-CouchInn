<?php
echo form_open_multipart('index.php/couch/agregarCouch');
?>

<div class="container" style="">
	<div class="form-group col-md-offset-2 col-md-8">

		<h2> Agregar un Couch: </h2>
		<br>

		<!-- Titulo -->
		<label for="titulo"> Titulo: </label>
		<input type="text" name="titulo" value="<?php if(isset($_POST['titulo'])) echo $_POST['titulo']; ?>" class="form-control" placeholder="Título del Couch, (Máximo 50 letras)" size="50" maxlength="50">
		<?php if(!empty(form_error('titulo'))){
				echo '<div class="alert alert-danger">';
				echo form_error('titulo');
				echo '</div>';
			}
			?>
		<br>
		
		<!-- Descripcion -->
		<label for="descripcion"> Descripcion: </label>
		<input type="text" name="descripcion" value="<?php if(isset($_POST['descripcion'])) echo $_POST['descripcion']; ?>" class="form-control" placeholder="Descripcion del Couch " size="50" maxlength="200">
		<?php if(!empty(form_error('descripcion'))){
				echo '<div class="alert alert-danger">';
				echo form_error('descripcion');
				echo '</div>';
			}
			?>
		<br>

		<!-- Localidad -->
		<label for="localidad"> Localidad: </label>
		<input type="text" name="localidad" value="<?php if(isset($_POST['localidad'])) echo $_POST['localidad']; ?>" class="form-control" placeholder="Localidad del couch, ej: La Plata" size="50" maxlength="50">
		<?php if(!empty(form_error('localidad'))){
				echo '<div class="alert alert-danger">';
				echo form_error('localidad');
				echo '</div>';
			}
			?>
		<br>

		<!-- Capacidad -->
		<label for="capacidad"> Capacidad (entre 1 y 12): </label>
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
		<label for="tipo">Tipo de hospedaje nuevo: </label>
		<select class="form-control" name="tipo" id="tipo" >
		<?php 
			foreach ($tipos as $tipo) {
				echo '<option value="'.$tipo->id_tipo.'">'.$tipo->tipo."</option>";
			}
		 ?>
		</select>
		<br>
		
		<!-- Usuario --> 
		<?php $emailUsuario = $this->session->userdata('email'); ?>
		<input type="hidden" name="usuario" id="usuario" value="<?php echo $emailUsuario; ?>">

		<!-- Imagen -->
		<label for="imagen1" class="control-label"> Imagen principal: </label>
		<p>Esta es la imagen que se verá en el inicio si usted es premium. </p>
		<p>(gif, jpg o png)</p>
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
		
		

		<input type="submit" value="Enviar" class="btn btn-default" />
	</div>
</div>