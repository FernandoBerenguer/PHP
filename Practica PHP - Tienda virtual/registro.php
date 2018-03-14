<?php
session_start();
$_SESSION['tipo']="invitado";
include('funciones.php');
echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
cabecera('');
echo "</div>";
echo "<h2>Formulario de registro</h2>";

echo "<div class=\"container-fluid\"><form method=\"post\" action=\"datos_registro.php\">
  <div class=\"form-group col-3 offset-4\">
    <label for=\"dni\">DNI:</label>
    <input type=\"text\" class=\"form-control \" name=\"dni\" required>
  </div>
  <div class=\"form-group col-3 offset-4\">
    <label for=\"nombre\">Nombre:</label>
    <input type=\"text\" class=\"form-control \" name=\"nombre\" required>
  </div>
  <div class=\"form-group col-3 offset-4\">
  <label for=\"direccion\">Direccion:</label>
  <input type=\"text\" class=\"form-control\" name=\"direccion\" required>
</div>
<div class=\"form-group col-3 offset-4\">
  <label for=\"usuario\">Usuario:</label>
  <input type=\"text\" class=\"form-control\" name=\"usuario\" required>
</div> 
<div class=\"form-group col-3 offset-4\">
  <label for=\"contraseña\">Contraseña:</label>
  <input type=\"password\" class=\"form-control\" name=\"contraseña\" required>
</div> 
  <button type=\"submit\" class=\"btn btn-primary offset-5\">Aceptar</button>
</form></div> ";


pie();
?>