<?php
session_start();

if (isset($_SESSION['tipo'])) {


	if ($_SESSION['tipo']=="invitado"){
	include('funciones.php');
	echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
	cabecera('');
	echo "</div>";
	echo "<h2>Bienvenido a tu tienda de discos</h2>";
	echo "<center><p>Aqui encontraras una gran variedad de musica, tanto en formato CD, como en vinilo.</p></center>";
	pie();
	}
	else if ($_SESSION['tipo']=="usuario"){
		include('funciones_login.php');
		echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
		cabecera('');
		echo "</div>";
		echo "<h2>Bienvenido a tu tienda de discos: ".$_SESSION['usuario']."</h2>";
		echo "<center><p>Aqui encontraras una gran variedad de musica, tanto en formato CD, como en vinilo.</p></center>";
		pie();

	}
	else if ($_SESSION['tipo']=="admin") {
		include('funciones_admin.php');
		echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
		cabecera('');
		echo "</div>";
		echo "<h2>Bienvenido a tu tienda de discos: ".$_SESSION['usuario']."</h2>";
		echo "<center><p>Aqui encontraras una gran variedad de musica, tanto en formato CD, como en vinilo.</p></center>";
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
	echo "<h2>Bienvenido a tu tienda de discos</h2>";
	echo "<center><p>Aqui encontraras una gran variedad de musica, tanto en formato CD, como en vinilo.</p></center>";
	pie();
}

?>
