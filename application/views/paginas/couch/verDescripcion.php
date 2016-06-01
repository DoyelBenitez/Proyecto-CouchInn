<div class="container">
	<ul class="col-lg-offset-3 col-lg-6 list-group">
		<?php foreach ($imagen as $couch) { ?>
			<li class="row list-group-item">
				<p><img src= <?php echo site_url($couch->imagen) ?> alt="imagen" style="height:200px;width:550px"></p>	
			</li>
		<?php } 
		?>	
	</ul>
</div>




<div id="container">
	<h1>Descripcion</h1>

	<div id="body">
		<?php foreach ($couchs as $couch) { ?>
	<li class="row list-group-item">		
		<p><?php echo $couch->descripcion ?></p>
	<?php }
?>
	<div id="container">
	<h1>Porcentaje <?php echo $porcentaje ?> </h1>
	</div>


</div>







		



