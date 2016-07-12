

<?php 

$user = $this->session->userdata('email'); ?>

<?php	if ((!empty($user)) and ($couch->estado == 'normal')) { ?>

<div class="container" style="">
	<div class="panel panel-default col-md-offset-2 col-md-8"> 
		<?php echo form_open('/index.php/couch/Descripcion'); ?>
		<br>
		<textarea name='comentarios' rows="4" cols="100" maxlength="350" > 	</textarea>
		<?php if(!empty(form_error('comentarios'))){
						echo '<div class="alert alert-danger">';
						echo form_error('comentarios');
						echo '</div>';
					}
					?>

		<input type="hidden" size="15" maxlength="30" value="<?php echo $couch->id_couch; ?>" name="id_couch">
		<input type="submit" value="Comentar" class="btn btn-default" style="text-align:center"/>
		</form>

		

	</div>
</div>

<?php } ?>