<?php echo form_open('/index.php/sesiones/recuperar'); ?>

  <div class="container" style="">
    <div class="form-group col-md-offset-2 col-md-8">
      <h2>Recuperar contraseña olvidada</h2>
      <br>

        <label for="email"> Ingresa tu Email: </label>
        <input type="text" name="email" value="" class="form-control" placeholder="nombre@mail.com" size="50" maxlength="70" />
         
          <?php if(!empty(form_error('email'))){
           echo '<div class="alert alert-danger">';
           echo form_error('email');
           echo '</div>';
          }
          ?>
          
          <!-- Codigo de confirmacion
          <label for="pin"> Escriba el codigo que ve: (123) </label>
          <input type="text" name="pin" value="" class="form-control" placeholder="escriba el codigo de arriba" size="50" maxlength="3" />
    
           <?php /*if(!empty(form_error('pin'))){
             echo '<div class="alert alert-danger">';
             echo form_error('pin');
             echo '</div>';
          }*/
          ?>
        <br> -->

          
        <input type="submit" class="btn btn-default" value="Recuperar contraseña" />
      </div>
    </div>

</form>
 
    
