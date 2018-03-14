<?php
session_start();

include('funciones_index.php');
echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";
cabecera('');

echo "</div>";

if ($_SESSION['tipo'] == "invitado"){
	session_destroy();
	echo "<h2>No has iniciado sesion</h2>";
	echo "<form action=\"login.php\">";
	echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir iniciar sesion</button></center>";
	echo "</form>";
	
}else{
	session_destroy();
	echo "<h2> Has cerrado sesion correctamente</h2>";
	echo "<form action=\"index.php\">";
	echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir al inicio</button></center>";
	echo "</form>";
	
}


pie();
?>