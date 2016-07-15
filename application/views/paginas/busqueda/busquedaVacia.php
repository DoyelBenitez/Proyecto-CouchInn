<div class="container" style="text-align:center">
<h2>No se encontro coincidencia para su patron de busqueda </h2>

<form class="form-inline" role="form">
<H4>Busqueda por: 
<?php

if (!empty($post['cabaña']))
 {
     $post['cabaña'] =substr($post['cabaña'], 0 , -1); 
 }
    if (!empty($post['dpto'])) 
 {
     $post['dpto'] = substr($post['dpto'], 0, -1);
 }
    if (!empty($post['casa'])) 
 {
     $post['casa'] = substr($post['casa'], 0, -1);
 }
    if (!empty($post['Habitacion'])) 
 {
     $post['Habitacion'] = substr($post['Habitacion'], 0, -1);
 }
     foreach ($post as $caso_prueba)
    {

       if ($caso_prueba != 'true' and $caso_prueba != 'false') {
            echo $caso_prueba . " ";
       }
   }
 
 ?>
</form>

<a href="<?php echo site_url('index.php'); ?>">
		<p> Volver</p>
		</a>

		</div>