
<?php echo form_open('index.php') ?>
<div class="form-group col-md-offset-4 col-md-4">
<H3>Busqueda por: </H3>
</div>

<form class="form-inline" role="form"> <!-- SE SUPONE QUE TE LO ORGANIZA HORIZONTALMENTE -->
<div class="container" style="">
		<div class="form-group col-md-offset-4 col-md-4">
<h4> Tipo </h4>


<?php
	foreach ($tipo as $valor) 
        {	 ?>
        		

        	<div class="form-group">
	        	<div class="checkbox">
	        		<label><input type="checkbox" name= <?php echo $valor->tipo ?> value= <?php echo $valor->tipo . "1" ?>> <?php echo $valor->tipo  ?></label>
        		</div>
        	</div>	

        		
<?php 	} ?>


	

	
 		<input name="descripcion" type="text" class="form-control" placeholder="Busqueda por descripcion" value="<?php if(isset($_POST['descripcion'])) echo $_POST['descripcion']; ?>" size="50" maxlength="70"  > </input>

 		<?php if(!empty(form_error('descripcion'))){
				echo '<div class="alert alert-danger">';
				echo form_error('descripcion');
				echo '</div>';
			}
			?>	
 		
 		<input name="titulo" type="text" class="form-control" value="<?php if(isset($_POST['titulo'])) echo $_POST['titulo']; ?>" placeholder="Busqueda por Titulo" size="50" maxlength="70" >  </input>

 		<?php if(!empty(form_error('titulo'))){
				echo '<div class="alert alert-danger">';
				echo form_error('titulo');
				echo '</div>';
			}
			?>
		
		<input name="Localidad" type="text" value="<?php if(isset($_POST['Localidad'])) echo $_POST['Localidad']; ?>" class="form-control" placeholder="Busqueda por Localidad" size="50" maxlength="70"  > </input>

		<?php if(!empty(form_error('Localidad'))){
				echo '<div class="alert alert-danger">';
				echo form_error('Localidad');
				echo '</div>';
			}
			?>
				<input name="cantPersonas" type="text" class="form-control" placeholder="Capacidad (Max 25)" value="<?php if(isset($_POST['cantPersonas'])) echo $_POST['cantPersonas']; ?>" size="10" maxlength="10"  > </input>

 		<?php if(!empty(form_error('cantPersonas'))){
				echo '<div class="alert alert-danger">';
				echo form_error('capacidad');
				echo '</div>';
			}
			?>

	<h4>Disponibilidad</h4>
	<label for="desde"> Desde: </label>
		<input type="date" name="desde"  value="<?php if(isset($_POST['desde'])) echo $_POST['desde']; ?>" class="form-control" step="1" min="2015-01-02" max="2018-12-31" />
		
			
	
		<label for="hasta"> Hasta: </label>
		<input type="date" name="hasta" value="<?php if(isset($_POST['hasta'])) echo $_POST['hasta']; ?>" class="form-control"  step="1" min="2015-01-02" max="2018-12-31" />
		
			<?php if(!empty(form_error('hasta'))){
				echo '<div class="alert alert-danger">';
				echo 'Los campos fechas deben completarse';
				echo '</div>';
			}
			?>




	<button name="boton" type="submit" class="btn btn-default">Buscar</button>

	</div>
	</div>
</form>





				


