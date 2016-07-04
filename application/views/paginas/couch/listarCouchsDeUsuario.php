
<h3 style="text-align:center">Mis Couchs:</h3>
<div class="container" >
	<ul class="list-group">
		<?php if(empty($couchs)) echo '<li class="list-group-item" style="text-align:center"> No has agregado ningun couch todavia </li>'  ?>
		<?php foreach ($couchs as $key => $couch) { ?>
			
			<li class="list-group-item" > <?php echo ($key+1).'. '; echo $couch->titulo ?>
			<br><br>
			<div class="btn-toolbar" role="group" aria-label="...">
				
				<!--Boton ver -->
				<form method="post" action="<?php echo site_url('index.php/couch/descripcion'); ?>">
					<input type="hidden" name="id_couch" id="id_couch" value="<?php echo ($couch->id_couch); ?>">
					<input type="submit" class="btn btn-default" value="Ver">
				</form>

				<!--Boton despublicar -->
				<?php if ($couch->estado == 'normal') { ?>
					<form method="post" action="<?php echo site_url('index.php/couch/despublicarCouch'); ?>">
						<input type="hidden" name="id_couch" id="id_couch" value="<?php echo ($couch->id_couch); ?>">
						<input type="submit" class="btn btn-default" value="Despublicar">
					</form>
				<?php } ?>

				<!--Boton publicar -->
				<?php if ($couch->estado == 'despublicado') { ?>
					<form method="post" action="<?php echo site_url('index.php/couch/publicarCouch'); ?>">
						<input type="hidden" name="id_couch" id="id_couch" value="<?php echo ($couch->id_couch); ?>">
						<input type="submit" class="btn btn-default" value="Publicar">
					</form>
				<?php } ?>
				
				<!--Boton eliminar -->
				<form method="post" action="<?php echo site_url('index.php/couch/eliminarCouch/'); ?>">
					<input type="hidden" name="id_couch" id="id_couch" value="<?php echo ($couch->id_couch); ?>">
					<input type="submit" <?php echo 'onclick="confirmacionEliminar(event)"'; ?> class="btn btn-default" value="Eliminar">
				</form>
				
				<!--Boton modificar -->
				<form method="link" action="<?php echo site_url('index.php/couch/modificarCouch/').'/'.$couch->id_couch; ?>">
					<input type="submit" class="btn btn-default" value="Modificar">
				</form>
			</div>
			<br>
			</li>

		<?php } ?>


		<script>
			function confirmacionEliminar(event) {
				debugger;
				if(!confirm('¿Seguro que quiere eliminar el couch?')){
					event.preventDefault();
				}
			}
			</script>
	</ul>
</div>
<br>