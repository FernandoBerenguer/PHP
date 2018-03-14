<?php
session_start();

echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";


echo "</div>";
if (isset($_SESSION['tipo']) && isset($_POST['usuario']) && isset($_POST['clave'])) {
	
	
	$usuario=$_POST['usuario'];
	$clave=$_POST['clave'];
	$clavemd5=md5($_POST['clave']);


	$conexion = mysqli_connect("localhost","root","","fernandisco" )or die ("No se pudo conectar");
	mysqli_set_charset($conexion, "utf8");
	$sql="select *
	FROM clientes WHERE USUARIO='".$usuario."' and PASSWORD='".$clavemd5."'";
	$resultado=mysqli_query($conexion,$sql);
	$arrayUser=mysqli_fetch_assoc($resultado);


	if (empty($usuario) && empty($clave)){
		include('funciones_index.php');
		cabecera('');
		$_SESSION['tipo']="invitado";

		echo "<h2>Has iniciado sesion como: ".$_SESSION['tipo']."</h2>";
		echo "<form action=\"index.php\">";
		echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir al inicio</button></center>";
		echo "</form>";
	}  
	else if (mysqli_num_rows($resultado)!=0){

			$_SESSION['usuario']=$arrayUser['USUARIO'];
			$_SESSION['dni']=$arrayUser['DNI'];
			$_SESSION['nombreuser']=$arrayUser['NOMBRE'];
			$_SESSION['direccion']=$arrayUser['DIRECCION'];
			$_SESSION['clave']=$arrayUser['PASSWORD'];

			
			if ($usuario == "admin"){
				include('funciones_admin.php');
				cabecera('');
				$_SESSION['tipo']="admin";
				echo "<h2>Has iniciado sesion como: ".$_SESSION['usuario']."</h2>";
				echo "<form action=\"index.php\">";
				echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir al inicio</button></center>";
				echo "</form>";
			}
			else {
				include('funciones_login.php');
				cabecera('');
				$_SESSION['tipo']="usuario";
				echo "<h2>Has iniciado sesion como: ".$_SESSION['usuario']."</h2>";
				echo "<form action=\"index.php\">";
				echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir al inicio</button></center>";
				echo "</form>";
			}
	}
	else if (mysqli_num_rows($resultado)==0)
	{
		include('funciones_index.php');
		cabecera('');
		$_SESSION['tipo']="invitado";
		echo "<h2>Usuario o contraseña incorrectos</h2>";
		pie();
	}
}else{

	if ($_SESSION['tipo']=="admin") {
		include('funciones_admin.php');
		cabecera('');
		echo "<h2>Has iniciado sesion como: ".$_SESSION['tipo']."</h2>";
		echo "<form action=\"index.php\">";
		echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir al inicio</button></center>";
		echo "</form>";
		pie();
	}
	else if($_SESSION['tipo']=="usuario"){
		include('funciones_login.php');
		cabecera('');
		echo "<h2>Has iniciado sesion como: ".$_SESSION['tipo']."</h2>";
		echo "<form action=\"index.php\">";
		echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir al inicio</button></center>";
		echo "</form>";
		pie();
	}else {
		include('funciones.php');
		cabecera('');
		$_SESSION['tipo']="invitado";
		echo "<h2>No has iniciado sesion</h2>";
		echo "<form action=\"login.php\">";
		echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir iniciar sesion</button></center>";
		echo "</form>";
		pie();
	}
}


?>