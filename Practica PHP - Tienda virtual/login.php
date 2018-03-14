<?php
session_start();
$_SESSION['tipo']="invitado";
include('funciones_index.php');
echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";
cabecera('');

echo "</div>";
?>
<center>
	<h2>Acceso usuario.</h2>
<form method="POST" action="datos_login.php">
	<div class="form-group">
  Nombre de Usuario: <input type="text" class="form-control col-sm-2" name="usuario" maxlength="10"><br></div><div class="form-group">
  Clave: <input type="password" class="form-control col-sm-2" name="clave" maxlength="10"><br></div>
	</div>
  <input type="submit" class="btn btn-secondary" value="Iniciar Sesion">
</form>
<a href="registro.php">Registrate</a></center>
<?php
pie();
?>