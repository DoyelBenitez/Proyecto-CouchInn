

 
<div class="container-fluid">
 	
<?php foreach ($comentarios as $couch) { ?>
	<div class="">
			 <div class="">	

			 		<p> Usuario X Comento:  </p>
			 		<blockquote><p> <?php echo $couch->comentario ?> </p></blockquote>
			 		<input type="submit" value="responder" class="btn btn-default "/>
			 		<p> .   </p>
			 		<p> .   </p>
			 		<p>    </p>
			 		<p>    </p>
				</div>
			<?php } ?>
			
	</div>
</div>