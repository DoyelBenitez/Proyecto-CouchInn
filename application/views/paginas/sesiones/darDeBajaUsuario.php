<div class="container" style="text-align:center">
	<h4>Darse de baja a CouchInn:</h4>
	<p>Si Confirma darse de baja al sistema su cuenta quedará inactiva y no podrá usarla más.</p>
	
	<form method="post" action="<?php site_url('index.php/sesiones/darDeBajaUsuario') ?>">
		<input type="hidden" name="confirmar" id="confirmar" value="ok">
		<input type="submit" onclick="confirmacionEliminar(event)" class="btn btn-default" value="Confirmar baja al sistema">
	</form>
	<br><br>

	<form method="post" action="<?php site_url(); ?>">
		<input type="submit" class="btn btn-default" value="Volver al inicio">
	</form>
	
	<script>
	function confirmacionEliminar(event) {
		debugger;
		if(!confirm('¿Seguro que quiere eliminar al usuario?')){
			event.preventDefault();
		}
	}
	</script>	
</div>