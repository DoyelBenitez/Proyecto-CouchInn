<div class="container" style="text-align:center">
<h2>No se encontro coincidencia para su patron de busqueda </h2>

<form class="form-inline" role="form">
<H4>Busqueda por: 

<?php foreach ($post as $caso_prueba) {
	
	if (preg_match('/[0-9]{1}/', $caso_prueba) and ($caso_prueba != 99) and ($caso_prueba != 5) and ($caso_prueba != 10))
	{	
		$caso_prueba = substr($caso_prueba, 0 , -1);
		echo $caso_prueba . " ";
    }
    elseif ($caso_prueba == 99) {
    	echo "'mas de 10' ";
    }
    elseif ($caso_prueba == 5) {
    	echo "'5..10' ";
    }
    elseif ($caso_prueba == 10) {
    	echo "'1..5' ";
    }
    else {
    	echo $caso_prueba . " ";
    }

 }
 ?>
</form>

<a href="<?php echo site_url('index.php'); ?>">
		<p> Volver</p>
		</a>

		</div>