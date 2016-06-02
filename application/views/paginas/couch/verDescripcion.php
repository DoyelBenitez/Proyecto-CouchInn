<head>
	<meta charset="utf-8">
	<title>VerDescripción</title>

	<style type="text/css">

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

		body {
		color: #003399;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;		

	}


	</style>
	</head>


<div class="container">
	<center><h1>Descripción </h1></center>
		 <?php foreach ($couchs as $couch) { ?>
		<center><body><?php echo $couch->descripcion ?></body></center>
		<code>Porcentaje <?php echo $couch->Porcentaje ?> </code>
	<?php }?>
	
	</div>


</div>