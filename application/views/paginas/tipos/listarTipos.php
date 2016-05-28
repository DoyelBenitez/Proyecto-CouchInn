<div class="container">
	<ul class="col-lg-offset-3 col-lg-6 list-group">
		<h2> Tipos de Hospedaje: </h2>
		<br>
		<div style="margin: 0 auto; text-align:center">
			<a href="<?php echo site_url('index.php/tipos/agregarTipo');?>" style= "text-align:center" class="btn btn-default"> Agregar un tipo nuevo </a> 
		</div>
		<?php foreach ($tipos as $key => $tipo) { ?>
			<li class="row list-group-item">
				
				<h4><?php echo $key.'. ' . $tipo->tipo?></h4>

				<form method="link" action="<?php echo site_url('index.php/tipos/eliminarTipo/').'/'.$tipo->tipo; ?>">
					<input type="submit" class="btn btn-default" value="Eliminar">
				</form>
				<form method="link" action="<?php echo site_url('index.php/tipos/modificarTipo/').'/'.$tipo->tipo; ?>">
					<input type="submit" class="btn btn-default" value="Modificar">
				</form>

			</li>
		<?php } 
		?>	
	</ul>
</div>
