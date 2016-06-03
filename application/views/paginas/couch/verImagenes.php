<div class="container">
	<div class="  form-horizontal">

		<?php 
		foreach ($imagen as $couch) {

				echo '<img src=" '. site_url($couch->imagen).' " align="left" alt="imagen"  style="height:300px;width:300px" HSPACE="40" class="img-rounded" VSPACE="30" >';
		} ?>
	</div>
</div>

<div>
	<center><input type="submit" value="reservar(NO FUNCIONA)" class="btn btn-default"/></center>
</div>










		



