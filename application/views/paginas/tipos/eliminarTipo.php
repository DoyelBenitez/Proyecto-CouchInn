<?php echo form_open('index.php/admin/eliminarTipoConDatos'); ?>


<div style="text-align: center">
<?php echo form_label('Tipo:', 'nombre_tipo');

$data= array(
	'name' => 'nombre_tipo',
	'placeholder' => 'Ingrese nombre de tipo a eliminar',
	'style' => 'width:250px;'
	 );

echo form_input($data); 

?>
</div>

<div id="form_button" style="text-align: center">
<?php
	
	$data = array(
		'type' => 'submit',
		'value'=> 'Submit',
		'class'=> 'submit'
	);
	echo form_submit($data); 

?>
</div>

<?php echo form_close();?>