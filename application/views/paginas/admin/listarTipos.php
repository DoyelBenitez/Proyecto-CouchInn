<div class="container">
	<ul class="col-lg-offset-3 col-lg-6 list-group">
		<h2> Tipos de Hospedaje: </h2>
		<br>
		<?php foreach ($tipos as $tipo) { ?>
			<li class="row list-group-item">
				<h4><?php echo 'Tipo: ' . $tipo->tipo?></h4>
			</li>
		<?php } 
		?>	
	</ul>
</div>