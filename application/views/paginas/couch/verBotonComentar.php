<?php echo form_open('/index.php/couch/Descripcion'); ?>

<?php print_r($id_couch); 

$user = $this->session->userdata('email'); ?>

<?php	if (!empty($user)) { ?>


<html>
<body>
<div class="container" style="">
<div class="form-group col-md-offset-2 col-md-4"> 

	
<textarea name='comentarios' rows="10" cols="100" maxlength="350" > 	</textarea>
<?php if(!empty(form_error('comentarios'))){
				echo '<div class="alert alert-danger">';
				echo form_error('comentarios');
				echo '</div>';
			}
			?>

<input type="hidden" size="15" maxlength="30" value="<?php echo $id_couch ?>" name="id_couch">


<input type="submit" value="Enviar" class="btn btn-default "/>

</div>
</div>

</body>
<?php } ?>