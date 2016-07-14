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
    	echo "'hasta 5' ";
    }
    elseif ($caso_prueba == 10) {
    	echo "'hasta 10' ";
    }
    else {
    	echo $caso_prueba . " ";
    }

 }
 ?>
</form>