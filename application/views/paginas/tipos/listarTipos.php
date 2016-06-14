<div class="container">
	<ul class="col-lg-offset-3 col-lg-6 list-group">
	<div class="row">
		<h2 class="col-md-8"> Tipos de Hospedaje 
		</h2>
		<div class="col-md-4 pull-right" style="margin-top: 20px">
			<a href="<?php echo site_url('index.php/tipos/agregarTipo');?>" style= "text-align:center" class="btn btn-default"> Agregar un tipo nuevo </a> 
		</div>
	</div>
		<br>
		<?php foreach ($tipos as $key => $tipo) { ?>
			<li class="row list-group-item">
				
				<h4><?php echo $key.'. ' . $tipo->tipo?></h4>

				<form method="link" action="<?php echo site_url('index.php/tipos/eliminarTipo/').'/'.$tipo->id_tipo; ?>">
					<input type="submit" <?php if (!$couchsPorTipo[$tipo->tipo]) echo 'onclick="confirmacionEliminar(event)"'; ?> class="btn btn-default" value="Eliminar">
				</form>

				<form method="link" action="<?php echo site_url('index.php/tipos/modificarTipo/').'/'.$tipo->id_tipo; ?>">
					<input type="submit" class="btn btn-default" value="Modificar">
				</form>

			</li>
		<?php }

		?>

			<script>
			function confirmacionEliminar(event) {
				debugger;
				if(!confirm('¡Este tipo tiene couchs asociados! ¿Desea eliminarlo igual?')){
					event.preventDefault();
				}
			}
			</script>	
	</ul>
</div>
