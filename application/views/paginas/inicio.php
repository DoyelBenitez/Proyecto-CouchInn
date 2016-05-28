<div class="container">
	<ul class="col-lg-offset-3 col-lg-6 list-group">
		<?php foreach ($couchs as $couch) { ?>
			<li class="row list-group-item">
				<h3><?php echo $couch->titulo ?></h3>
				<p><img src= <?php echo $couch->imagen ?> alt="imagen" style="height:400px;width:500px"></p>
				<p><?php echo $couch->descripcion ?></p>
			</li>
		<?php } 
		?>	
	</ul>
</div>

<div style="margin: 0 auto; text-align: center">
	<a href="<?php echo site_url('index.php/tipos/listarTipos');?>" style="text-align: center" > Listar Tipos </a>
	<br>
</div>