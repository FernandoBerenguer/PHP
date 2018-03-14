<?php
session_start();
$_SESSION['tipo']="invitado";
include('funciones.php');
echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
cabecera('');
echo "</div>";

$conexion = mysqli_connect("localhost","root","","fernandisco" )or die ("No se pudo conectar");
mysqli_set_charset($conexion, "utf8");

if (empty($_POST["dni"]) || empty($_POST["nombre"]) || empty($_POST["direccion"]) || empty($_POST["usuario"]) || empty($_POST["contraseña"])){

	echo "<h2>No puede dejar datos sin rellenar, por favor, rellene todos los campos</h2>";
	echo "<form action=\"registro.php\">";
echo "<center><button type=\"submit\" class=\"btn btn-primary\">Volver a registro</button></center>";
echo "</form>";
}
else{
$dni=$_POST["dni"];
$nombre=$_POST["nombre"];
$direccion=$_POST["direccion"];
$usuario=$_POST["usuario"];
$password=$_POST["contraseña"];


$sql= "insert into clientes (dni, nombre, direccion, usuario, password)
	VALUES ('".$dni."', '".$nombre."', '".$direccion."', '".$usuario."', '".md5($password)."')";

$resultado=mysqli_query($conexion, $sql);

if ($resultado){
	echo "<h2>Usuario registrado correctamente</h2>";
}
else{
	echo "<h2>Fallo en el registro</h2>";
}

echo "<form action=\"index.php\">";
echo "<center><button type=\"submit\" class=\"btn btn-primary\">Aceptar</button></center>";
echo "</form>";
}
pie();
?>