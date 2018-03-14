<?php
session_start();


if (!isset($_GET["borrar"])) 
{

	if (isset($_POST['nombre']))
	{
		$nombre=$_POST['nombre'];
		$artista=$_POST['artista'];
		$precio=$_POST['precio'];
		$stock=$_POST['stock'];
		$unidades=$_POST['unid'];
		$cod=$_POST['cod'];

		if (isset($_SESSION['cod_producto']))
		{
			//si tengo productos en la cesta
			if (!in_array($cod, $_SESSION["cod_producto"])) 
			{
				//no esta el producto en la cesta
				$_SESSION['contador']=$_SESSION['contador']+1;
				$indice=$_SESSION['contador']-1;
				$_SESSION["cod_producto"][]=$cod;
				$_SESSION['nombre'][]=$nombre;
				$_SESSION['artista'][]=$artista;
				$_SESSION['precio'][]=$precio;
				$_SESSION['unidades'][]=$unidades;
				$subtotal=$precio*$unidades;
				$_SESSION['stock'][]=$stock-$unidades;
				$_SESSION['total']=$_SESSION['total']+($precio*$unidades);

				mostrar();
				
			}
			else
			{
				//el producto ya esta
				$indice=array_search($cod, $_SESSION["cod_producto"]);

				$_SESSION['unidades'][$indice]=$_SESSION['unidades'][$indice]+$unidades;

				$_SESSION['total']=$_SESSION['total']+($_SESSION['precio'][$indice]*$unidades);
				mostrar();
			}

		}
		else
		{
		//no hay productos en la cesta
		$_SESSION['contador']=1;
		$_SESSION["cod_producto"][0]=$cod;
		$_SESSION['nombre'][0]=$nombre;
		$_SESSION['artista'][0]=$artista;
		$_SESSION['precio'][0]=$precio;
		$_SESSION['unidades'][0]=$unidades;
		$_SESSION['total']=$precio*$unidades;
		$_SESSION['stock'][0]=$stock-$unidades;

		mostrar();

		}
	}
	else
	{
		//no llega nada de productos
		if (isset($_SESSION['cod_producto']))
		{
			mostrar();
		}
		else
		{
			if ($_SESSION['tipo']=="invitado"){
				include('funciones.php');
				echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
				cabecera('');
				echo "</div>";
				echo "<h2>No has iniciado sesion</h2>";
				echo "<form action=\"login.php\">";
				echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir iniciar sesion</button></center>";
				pie();
				}
				else if ($_SESSION['tipo']=="usuario"){
					include('funciones_login.php');
					echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
					cabecera('');
					echo "</div>";
					//cesta vacia
					echo "<div class=\"container\">
						<div class=\"card col-10 offset-1\">
			   			
						<div class=\"card-header bg-secondary text-white\"><h3>Cesta vacia</h3>
						<p>Ve al catalogo para ver que quieres comprar</p>
						</div>
			   			<div class=\"card-body\">
			   			<form action=\"productos.php\">
						<center><button type=\"submit\" class=\"btn btn-primary\">Ir al catalogo</button></center></form>
			   			</div></div>";
					pie();

				}
				else if ($_SESSION['tipo']=="admin") {
					include('funciones_admin.php');
					echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
					cabecera('');
					echo "</div>";
					//cesta vacia
					echo "<div class=\"container\">
						<div class=\"card col-10 offset-1\">
			   			
						<div class=\"card-header bg-secondary text-white\"><h3>Cesta vacia</h3>
						<p>Ve al catalogo para ver que quieres comprar</p>
						</div>
			   			<div class=\"card-body\">
			   			<form action=\"productos.php\">
						<center><button type=\"submit\" class=\"btn btn-primary\">Ir al catalogo</button></center></form>
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
		}
}
else
{
	//acciones de borrar
	$borrarIndice=$_GET["valor"];
	if(isset($_SESSION["cod_producto"])){
	
	$_SESSION["total"]=$_SESSION["total"]-($_SESSION["precio"][$borrarIndice]*$_SESSION["unidades"][$borrarIndice]);
	$_SESSION["contador"]=$_SESSION["contador"]-1;
	if ($_SESSION["contador"] == 0) {

	unset($_SESSION["precio"][$borrarIndice]);
	unset($_SESSION["unidades"][$borrarIndice]);
	unset($_SESSION['nombre'][$borrarIndice]);
	unset($_SESSION['artista'][$borrarIndice]);
	unset($_SESSION['cod_producto'][$borrarIndice]);
	unset($_SESSION['total']);

		if ($_SESSION['tipo']=="invitado"){
				include('funciones.php');
				echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
				cabecera('');
				echo "</div>";
				echo "<h2>No has iniciado sesion</h2>";
				echo "<form action=\"login.php\">";
				echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir iniciar sesion</button></center>";
				pie();
				}
				else if ($_SESSION['tipo']=="usuario"){
					include('funciones_login.php');
					echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
					cabecera('');
					echo "</div>";
					//cesta vacia
					echo "<div class=\"container\">
						<div class=\"card col-10 offset-1\">
			   			
						<div class=\"card-header bg-secondary text-white\"><h3>Cesta vacia</h3>
						<p>Ve al catalogo para ver que quieres comprar</p>
						</div>
			   			<div class=\"card-body\">
			   			<form action=\"productos.php\">
						<center><button type=\"submit\" class=\"btn btn-primary\">Ir al catalogo</button></center></form>
			   			</div></div>";
					pie();

				}
				else if ($_SESSION['tipo']=="admin") {
					include('funciones_admin.php');
					echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
					cabecera('');
					echo "</div>";
					//cesta vacia
					echo "<div class=\"container\">
						<div class=\"card col-10 offset-1\">
			   			
						<div class=\"card-header bg-secondary text-white\"><h3>Cesta vacia</h3>
						<p>Ve al catalogo para ver que quieres comprar</p>
						</div>
			   			<div class=\"card-body\">
			   			<form action=\"productos.php\">
						<center><button type=\"submit\" class=\"btn btn-primary\">Ir al catalogo</button></center></form>
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

	}else{
	unset($_SESSION["precio"][$borrarIndice]);
	unset($_SESSION["unidades"][$borrarIndice]);
	unset($_SESSION['nombre'][$borrarIndice]);
	unset($_SESSION['artista'][$borrarIndice]);
	unset($_SESSION['cod_producto'][$borrarIndice]);
	mostrar();
	}
}
else{

	if ($_SESSION['tipo']=="invitado"){
				include('funciones.php');
				echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
				cabecera('');
				echo "</div>";
				echo "<h2>No has iniciado sesion</h2>";
				echo "<form action=\"login.php\">";
				echo "<center><button type=\"submit\" class=\"btn btn-primary\">Ir iniciar sesion</button></center>";
				pie();
				}
				else if ($_SESSION['tipo']=="usuario"){
					include('funciones_login.php');
					echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
					cabecera('');
					echo "</div>";
					//cesta vacia
					echo "<div class=\"container\">
						<div class=\"card col-10 offset-1\">
			   			
						<div class=\"card-header bg-secondary text-white\"><h3>Cesta vacia</h3>
						<p>Ve al catalogo para ver que quieres comprar</p>
						</div>
			   			<div class=\"card-body\">
			   			<form action=\"productos.php\">
						<center><button type=\"submit\" class=\"btn btn-primary\">Ir al catalogo</button></center></form>
			   			</div></div>";
					pie();

				}
				else if ($_SESSION['tipo']=="admin") {
					include('funciones_admin.php');
					echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
					cabecera('');
					echo "</div>";
					//cesta vacia
					echo "<div class=\"container\">
						<div class=\"card col-10 offset-1\">
			   			
						<div class=\"card-header bg-secondary text-white\"><h3>Cesta vacia</h3>
						<p>Ve al catalogo para ver que quieres comprar</p>
						</div>
			   			<div class=\"card-body\">
			   			<form action=\"productos.php\">
						<center><button type=\"submit\" class=\"btn btn-primary\">Ir al catalogo</button></center></form>
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
}
		


function mostrar()
{
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
						//aqui la cesta
						echo "<div class=\"container\">
							<div class=\"card col-10 offset-1\">
				   			
							<div class=\"card-header bg-secondary text-white\"><h3>Carrito</h3>
							<p>Productos seleccionados. Pulsa ACEPTAR para comprar.</p>
							</div>
				   			<div class=\"card-body\">
							<div class=\"container-fluid\">
							<table class='table table-bordered'><thead><tr>
							        <th>Nombre disco</th>
							        <th>Artista</th>
							        <th>Precio</th>
							        <th>Unidades</th>
							        <th>Eliminar</th>
							      </tr></thead>
							      <tbody>";

							   foreach ($_SESSION['cod_producto'] as $key => $value) {

							      	 	echo "<tr><td>".$_SESSION['nombre'][$key]."</td>
									        <td>".$_SESSION['artista'][$key]."</td>
									        <td>".$_SESSION['precio'][$key]."</td>
									        <td>".$_SESSION['unidades'][$key]."</td>		
									        <td><a href=\"cesta.php?borrar=S&valor=".$key."\" name=\"borrar\" class=\"btn btn-danger\">Eliminar</a></td></tr>"; 	 	
								  }
									        
									echo "
									<tr>
								      <td colspan=4 align='center'>TOTAL</td>
								      <td>".$_SESSION['total']."</td>
								    </tr>
									</tbody></table></div>
							<center><a href=\"productos.php\" class=\"btn btn-primary col-3\">Seguir comprando</a>
							<a href=\"confirmar.php\" class=\"btn btn-success col-3\">Confirmar compra</a></center></div>
							</div></div>
							";
						pie();

					}
					else if ($_SESSION['tipo']=="admin") {
						include('funciones_admin.php');
						echo "<h1>FernanDISCO <img src='img/man.png'></h1>";
						cabecera('');
						echo "</div>";
						//aqui la cesta
						echo "<div class=\"container\">
							<div class=\"card col-10 offset-1\">
				   			
							<div class=\"card-header bg-secondary text-white\"><h3>Carrito</h3>
							<p>Productos seleccionados. Pulsa ACEPTAR para comprar.</p>
							</div>
				   			<div class=\"card-body\">
							<div class=\"container-fluid\">
							<table class='table table-bordered'><thead><tr>
							        <th>Nombre disco</th>
							        <th>Artista</th>
							        <th>Precio</th>
							        <th>Unidades</th>
							        <th>Eliminar</th>
							      </tr></thead>
							      <tbody>";

							 foreach ($_SESSION['cod_producto'] as $key => $value) {

							      	 	echo "<tr><td>".$_SESSION['nombre'][$key]."</td>
									        <td>".$_SESSION['artista'][$key]."</td>
									        <td>".$_SESSION['precio'][$key]."</td>
									        <td>".$_SESSION['unidades'][$key]."</td>
									        <td><a href=\"cesta.php?borrar=&valor=".$key."\" name=\"borrar\" class=\"btn btn-danger\">Eliminar</a></td></tr>"; 		  	
								  }
									        
									echo "
									<tr>
								      <td colspan=4 align='center'>TOTAL</td>
								      <td>".$_SESSION['total']."</td>
								    </tr></tbody></table></div>
							<center><a href=\"productos.php\" class=\"btn btn-primary col-3\">Seguir comprando</a>
							<a href=\"confirmar.php\" class=\"btn btn-success col-3\">Confirmar compra</a></center></div>
							</div></div>
							  ";
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
}

?>