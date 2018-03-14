<?php
session_start();

echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";
echo "</div>";


if (!isset($_POST['aceptar'])) {

	if (isset($_SESSION['tipo'])){

		if ($_SESSION['tipo']=="admin") {
			include('funciones_admin.php');
			cabecera('');
			//formulario para modificar datos
			echo "<div class=\"container\">
			<div class=\"card col-10 offset-1\">
   			
			<div class=\"card-header bg-secondary text-white\"><h3>Mis datos</h3>
			<p>Modifica tus datos. Pulsa ACEPTAR para guardar los cambios</p>
			</div>
   			<div class=\"card-body\">


			<div class=\"container-fluid\"><form method=\"post\" action=\"datos.php\">
				  <div class=\"form-group col-3 offset-4\">
				    <label for=\"dni\">DNI:</label>
				    <input type=\"text\" class=\"form-control \" name=\"dni\" value=\"".$_SESSION['dni']."\" required>	
				     </div>
				  <div class=\"form-group col-3 offset-4\">
				    <label for=\"nombre\">Nombre:</label>
				    <input type=\"text\" class=\"form-control \" name=\"nombre\" value=\"".$_SESSION['nombreuser']."\" required>
				  </div>
				  <div class=\"form-group col-3 offset-4\">
				  <label for=\"direccion\">Direccion:</label>
				  <input type=\"text\" class=\"form-control\" name=\"direccion\" value=\"".$_SESSION['direccion']."\" required>
				</div>
				<div class=\"form-group col-3 offset-4\">
				  <label for=\"usuario\">Usuario:</label>
				  <input type=\"text\" class=\"form-control\" name=\"usuario\" value=\"".$_SESSION['usuario']."\" required>
				</div> 
				<div class=\"form-group col-3 offset-4\">
				  <label for=\"contraseña\">Contraseña:</label>
				  <input type=\"password\" class=\"form-control\" name=\"contraseña\" required >
				</div> 
				  <button type=\"submit\" name=\"aceptar\" class=\"btn btn-primary offset-5\">Aceptar</button>
				</form></div></div></div> ";
			pie();
		}
		else if($_SESSION['tipo']=="usuario"){
			include('funciones_login.php');
			cabecera('');
			//formulario para modificar datos
				echo "<div class=\"container\">
			<div class=\"card col-10 offset-1\">
   			
			<div class=\"card-header bg-secondary text-white\"><h3>Mis datos</h3>
			<p>Modifica tus datos. Pulsa ACEPTAR para guardar los cambios</p>
			</div>
   			<div class=\"card-body\">


			<div class=\"container-fluid\"><form method=\"post\" action=\"datos.php\">
				  <div class=\"form-group col-3 offset-4\">
				    <label for=\"dni\">DNI:</label>
				    <input type=\"text\" class=\"form-control \" name=\"dni\" value=\"".$_SESSION['dni']."\" required>
				  </div>
				  <div class=\"form-group col-3 offset-4\">
				    <label for=\"nombre\">Nombre:</label>
				    <input type=\"text\" class=\"form-control \" name=\"nombre\" value=\"".$_SESSION['nombreuser']."\" required>
				  </div>
				  <div class=\"form-group col-3 offset-4\">
				  <label for=\"direccion\">Direccion:</label>
				  <input type=\"text\" class=\"form-control\" name=\"direccion\" value=\"".$_SESSION['direccion']."\" required>
				</div>
				<div class=\"form-group col-3 offset-4\">
				  <label for=\"usuario\">Usuario:</label>
				  <input type=\"text\" class=\"form-control\" name=\"usuario\" value=\"".$_SESSION['usuario']."\" required>
				</div> 
				<div class=\"form-group col-3 offset-4\">
				  <label for=\"contraseña\">Contraseña:</label>
				  <input type=\"password\" class=\"form-control\" name=\"contraseña\" required>
				</div> 
				  <button type=\"submit\" name=\"aceptar\" class=\"btn btn-primary offset-5\">Aceptar</button>
				</form></div></div></div> ";
			pie();
		}

	}
	else{
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
else{
	$clave=md5($_POST['contraseña']);
	$_SESSION['dni']=$_POST['dni'];
	$_SESSION['nombre']=$_POST['nombre'];
	$_SESSION['direccion']=$_POST['direccion'];
	$usuario=$_POST['usuario'];

	//update de los datos de los formularios anteriores
	$conexion = mysqli_connect("localhost","root","","fernandisco" )or die ("No se pudo conectar");
	mysqli_set_charset($conexion, "utf8");
	$sql="update clientes set DNI='".$_SESSION['dni']."', NOMBRE='".$_SESSION['nombre']."', DIRECCION='".$_SESSION['direccion']."', USUARIO='".$usuario."', PASSWORD='".$clave."' where USUARIO='".$_SESSION['usuario']."'";
	$resultado=mysqli_query($conexion,$sql);
	$_SESSION['usuario']=$usuario;
	if ($_SESSION['tipo']=="admin") {
			include('funciones_admin.php');
			cabecera('');
			echo "<h2>Datos modificados correctamente</h2>";
			echo "<form action=\"index.php\">";
			echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir a inicio</button></center>";
			echo "</form>";
			pie();
		}
		else if($_SESSION['tipo']=="usuario"){
			include('funciones_login.php');
			cabecera('');
			echo "<h2>Datos modificados correctamente</h2>";
			echo "<form action=\"index.php\">";
			echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir a inicio</button></center>";
			echo "</form>";
			pie();
		}
	
	}

?>