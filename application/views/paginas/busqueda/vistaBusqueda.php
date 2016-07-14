
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

<h4> Capacidad  </h4>
	 
	 <div class="form-group">
	        	<div class="checkbox">
	        		<label><input type="checkbox" name= "cantPersonas" value= 5 > 1..5 </label>
        		</div>
        	</div>	
      
       <div class="form-group">
	        	<div class="checkbox">
	        		<label><input type="checkbox" name= "cantPersonas" value=10> 5..10  </label>
        		</div>
        	</div>	

        <div class="form-group">
	        	<div class="checkbox">
	        		<label><input type="checkbox" name= "cantPersonas" value= 99> mas de 10 </label>
        		</div>
        	</div>	
	
 		<input name="descripcion" type="text" class="form-control" placeholder="Busqueda por descripcion" value="<?php if(isset($_POST['descripcion'])) echo $_POST['descripcion']; ?>" size="50" maxlength="70"  > </input>	
 		
 		<input name="titulo" type="text" class="form-control" value="<?php if(isset($_POST['titulo'])) echo $_POST['titulo']; ?>" placeholder="Busqueda por Titulo" size="50" maxlength="70" >  </input>
		
		<input name="Localidad" type="text" value="<?php if(isset($_POST['Localidad'])) echo $_POST['Localidad']; ?>" class="form-control" placeholder="Busqueda por Localidad" size="50" maxlength="70"  > </input>
	
	<button name="boton" type="submit" class="btn btn-default">Buscar</button>

	</div>
	</div>
</form>





				


