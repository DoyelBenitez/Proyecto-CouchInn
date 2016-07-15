<form class="form-inline" role="form">
<H4>Busqueda por: 

<?php

if (!empty($post['campo']))
 {
     $post['campo'] =substr($post['campo'], 0 , -1); 
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




</H4>
</form>