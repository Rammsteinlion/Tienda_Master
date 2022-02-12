<h1>Registrarse</h1>

<?php 
if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete') :?>

    <script> 
    swal({
  title: "Feliciades!",
  text: "Registro con exito!",
  icon: "success",
  button: "Aceptar!",
        });
 </script>

<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>

    <script> 
    swal({
  title: "Error!",
  text: "Error al registrarse ingresa bien los datos!",
  icon: "warning",
  dangerMode: true,
  button: "Aceptar!",
        });
 </script>

<?php endif; ?>

<?php Utils::deleteSession('register'); ?>


<form method="POST" action="<?=base_url?>usuario/save">
<label for="nombre">Nombre:</label>
<input type="text" name="nombre"  placeholder="Ingresa tu nombre"/>

<label for="apellidos">Apellidos:</label>
<input type="text" name="apellidos"  placeholder="Ingresa tu apellidos"/>

<label for="email">Email:</label>
<input type="email" name="email"  placeholder="Ingresa tu email"/>

<label for="password">Contraseña:</label>
<input type="password" name="password"  placeholder="Ingresa tu contraseña"/>

    <input type="submit" value="Registar Datos">
</form>