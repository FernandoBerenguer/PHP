<?php
session_start();

$dni=$_SESSION["dni"];
$total=$_SESSION["total"];
$lineas=$_SESSION["cod_producto"];
$nombre=$_SESSION["nombre"];
$precio=$_SESSION["precio"];

$conexion = mysqli_connect("localhost","root","","fernandisco" )or die ("No se pudo conectar");

$sql="INSERT INTO pedidos (DNI, FECHA, TOTAL_PEDIDO) VALUES ('$dni', '".date('Y-m-d')."', '$total')";
$resultado=mysqli_query($conexion, $sql);
$idanterior=mysqli_insert_id($conexion);

foreach ($lineas as $key => $value) {
	
	$sql2="INSERT INTO lineas (NUM_PEDIDO, NUM_LINEA, PRODUCTO, PRECIO) VALUES ('$idanterior','$value', '".$nombre[$key]."', '".$precio[$key]."')";
	$resultado=mysqli_query($conexion, $sql2);
}


if (isset($_SESSION['tipo'])) {


	if ($_SESSION['tipo']=="invitado"){
	include('funciones.php');
	echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
	cabecera('');
	echo "</div>";
	echo "<h2>No has iniciado sesion</h2>";
	echo "<form action=\"login.php\">";
	echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir iniciar sesion</button></center>";
	echo "</form>";
	pie();
	}
	else if ($_SESSION['tipo']=="usuario"){
		include('funciones_login.php');
		echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
		cabecera('');
		echo "</div>";
		echo "<div class=\"container\">
			<div class=\"card col-10 offset-1\">
			   			
			<div class=\"card-header bg-secondary text-white\"><h3>Pedido registrado</h3>
			<p>Pedido realizado correctamente</p>
			</div>
			<div class=\"card-body\">
			<form action=\"index.php\">
			<center><button type=\"submit\" class=\"btn btn-primary\">Ir al inicio</button></center></form>
			</div></div>";
		pie();

	}
	else if ($_SESSION['tipo']=="admin") {
		include('funciones_admin.php');
		echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
		cabecera('');
		echo "</div>";
		echo "<div class=\"container\">
			<div class=\"card col-10 offset-1\">
			   			
			<div class=\"card-header bg-secondary text-white\"><h3>Pedido registrado</h3>
			<p>Pedido realizado correctamente</p>
			</div>
			<div class=\"card-body\">
			<form action=\"index.php\">
			<center><button type=\"submit\" class=\"btn btn-primary\">Ir al inicio</button></center></form>
			</div></div>";
		pie();
	}else{

	include('funciones.php');
	echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
	cabecera('');
	echo "</div>";
	echo "<h2>No has iniciado sesion</h2>";
	echo "<form action=\"login.php\">";
	echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir iniciar sesion</button></center>";
	echo "</form>";
	pie();
	}
}
else{
	$_SESSION['tipo']="invitado";
	include('funciones.php');
	echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
	cabecera('');
	echo "</div>";
	echo "<h2>No has iniciado sesion</h2>";
	echo "<form action=\"login.php\">";
	echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir iniciar sesion</button></center>";
	echo "</form>";
	pie();
}
mysqli_close($conexion);
?>