<?php
session_start();


$conexion = mysqli_connect("localhost","root","","fernandisco" )or die ("No se pudo conectar");
mysqli_set_charset($conexion, "utf8");
$genero = "select * from familia";
$resultado_genero=mysqli_query($conexion, $genero);
if (isset($_SESSION['tipo'])) {

	if ($_SESSION['tipo']=="invitado"){	
		include('funciones.php');
		echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";
		cabecera('');
		echo "</div>";

		if (!isset($_POST["boton"]) || $_POST['genero']==0){
			echo "<div class='container'>";
			echo '<div class="form-group">';
			echo "<form method='post' action='productos.php'>";
			echo '<select class="form-control col-3" name="genero">';

			echo "<option value='0'>Todos</option>";
			while ($valores=mysqli_fetch_array($resultado_genero)){
				echo "<option value='".$valores[0]."'>".$valores[1]."</option>";

			}

			echo "</select>";
			echo "<input type='submit' class='btn btn-primary' name='boton' value='Filtrar'>";
			echo "</form>";
			echo "</div>";
			echo "</div>";

			$sql="select familia.nombre, producto.nombre, producto.nombre_corto, producto.pvp, producto.stock from producto, familia where familia.cod=producto.familia";
			$resultado = mysqli_query($conexion, $sql);
			echo "<div class='container'><table class='table table-striped'><thead><tr>
			        <th>Nombre disco</th>
			        <th>Artista</th>
			        <th>Precio</th>
			        <th>Genero</th>
			        <th>Stock</th>
			      </tr></thead>";

			    while ($datos=mysqli_fetch_array($resultado))
			    {
				echo "<tbody><tr>
					        <td>".$datos[1]."</td>
					        <td>".$datos[2]."</td>
					        <td>".$datos[3]." €</td>
					        <td>".$datos[0]."</td>
					        <td>".$datos[4]."</td>
					      </tr>";
			    }
			    echo "</tbody></table></div>";
				
			}
		else{
			$genero=$_POST["genero"];
			$consulta="select familia.nombre, producto.nombre, producto.nombre_corto, producto.pvp, producto.stock from producto, familia where familia.cod=producto.familia and producto.familia='".$genero."'";
				$resultado2 = mysqli_query($conexion, $consulta);
			echo "<div class='container'>";
				echo '<div class="form-group">';
				echo "<form method='post' action='productos.php'>";
				echo '<select class="form-control col-3" name="genero">';

				echo "<option value='0'>Todos</option>";
				while ($valores=mysqli_fetch_array($resultado_genero)){
					if ($genero == $valores[0]) {
						echo "<option value='".$valores[0]."' selected>".$valores[1]."</option>";
					}
					else{
					echo "<option value='".$valores[0]."'>".$valores[1]."</option>";
					}
				}

				echo "</select>";
				echo "<input type='submit' class='btn btn-primary' name='boton' value='Filtrar'>";
				echo "</form>";
				echo "</div>";
				echo "</div>";
				
				
				echo "<div class='container'><table class='table table-striped '><thead><tr>
			        <th>Nombre disco</th>
			        <th>Artista</th>
			        <th>Precio</th>
			        <th>Genero</th>
			        <th>Stock</th>
			      </tr></thead>";
				while ($data=mysqli_fetch_array($resultado2)){
					echo "<tbody><tr>
					        <td>".$data[1]."</td>
					        <td>".$data[2]."</td>
					        <td>".$data[3]." €</td>
					        <td>".$data[0]."</td>
					        <td>".$data[4]."</td>
					      </tr>";
				}
				 echo "</tbody></table></div>";
				}
			pie();
			}
	else if ($_SESSION['tipo']=="usuario"){	
			include('funciones_login.php');
			echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";
			cabecera('');
			echo "</div>";

		if (!isset($_POST["boton"]) || $_POST['genero']==0){
			echo "<div class='container'>";
			echo '<div class="form-group">';
			echo "<form method='post' action='productos.php'>";
			echo '<select class="form-control col-3" name="genero">';

			echo "<option value='0'>Todos</option>";
			while ($valores=mysqli_fetch_array($resultado_genero)){
				echo "<option value='".$valores[0]."'>".$valores[1]."</option>";

			}

			echo "</select>";
			echo "<input type='submit' class='btn btn-primary' name='boton' value='Filtrar'>";
			echo "</form>";
			echo "</div>";
			echo "</div>";

			$sql="select familia.nombre as fam, producto.cod, producto.nombre, producto.nombre_corto, producto.pvp, producto.stock from producto, familia where familia.cod=producto.familia";
			$resultado = mysqli_query($conexion, $sql);
			echo "<div class='container'><table class='table table-striped'><thead><tr>
			        <th>Nombre disco</th>
			        <th>Artista</th>
			        <th>Precio</th>
			        <th>Genero</th>
			        <th>Unidades</th>
			        <th>Stock</th>
			        <th>Comprar</th>
			      </tr></thead>";

			    while ($datos=mysqli_fetch_assoc($resultado))
			    {
				echo "<tbody><tr>
					        <td>".$datos['nombre']."</td>
					        <td>".$datos['nombre_corto']."</td>
					        <td>".$datos['pvp']." €</td>
					        <td>".$datos['fam']."</td>
					        <form method='post' action='cesta.php'>
					        <td><input type=\"number\" name=\"unid\" min=\"1\" max=\"".$datos['stock']."\" value=\"1\"></td>
					        <td>".$datos['stock']."</td>
					        <td><input type='submit' class='btn btn-primary' name='comprar' value='Comprar'></td>
					      </tr>
					       <input type='hidden' name='nombre' value='".$datos['nombre']."'>
					      <input type='hidden' name='cod' value='".$datos['cod']."'>
					      <input type='hidden' name='artista' value='".$datos['nombre_corto']."'>
					      <input type='hidden' name='precio' value='".$datos['pvp']."'>
					      <input type='hidden' name='stock' value='".$datos['stock']."'>
					      </form>";
			    }
			    echo "</tbody></table></div>";
				
			}
		else{
			$genero=$_POST["genero"];
			$consulta="select familia.nombre as fam, producto.nombre, producto.cod, producto.nombre_corto, producto.pvp, producto.stock from producto, familia where familia.cod=producto.familia and producto.familia='".$genero."'";
				$resultado2 = mysqli_query($conexion, $consulta);
			echo "<div class='container'>";
				echo '<div class="form-group">';
				echo "<form method='post' action='productos.php'>";
				echo '<select class="form-control col-3" name="genero">';

				echo "<option value='0'>Todos</option>";
				while ($valores=mysqli_fetch_array($resultado_genero)){
					if ($genero == $valores[0]) {
						echo "<option value='".$valores[0]."' selected>".$valores[1]."</option>";
					}
					else{
					echo "<option value='".$valores[0]."'>".$valores[1]."</option>";
					}
				}

				echo "</select>";
				echo "<input type='submit' class='btn btn-primary' name='boton' value='Filtrar'>";
				echo "</form>";
				echo "</div>";
				echo "</div>";
				
				
				echo "<div class='container'><table class='table table-striped '><thead><tr>
			       <th>Nombre disco</th>
			        <th>Artista</th>
			        <th>Precio</th>
			        <th>Genero</th>
			        <th>Unidades</th>
			        <th>Stock</th>
			        <th>Comprar</th>
			      </tr></thead>";
				while ($data=mysqli_fetch_assoc($resultado2)){
					echo "<tbody><tr>
					        <td>".$data['nombre']."</td>
					        <td>".$data['nombre_corto']."</td>
					        <td>".$data['pvp']." €</td>
					        <td>".$data['fam']."</td>
					        <form method='post' action='cesta.php'>
					        <td><input type=\"number\" name=\"unid\" min=\"1\" max=\"".$data['stock']."\" value=\"1\"></td>
					        <td>".$data['stock']."</td>
					        <td><input type='submit' class='btn btn-primary' name='comprar' value='Comprar'></td>
					      </tr>
					       <input type='hidden' name='nombre' value='".$data['nombre']."'>
					      <input type='hidden' name='cod' value='".$data['cod']."'>
					      <input type='hidden' name='artista' value='".$data['nombre_corto']."'>
					      <input type='hidden' name='precio' value='".$data['pvp']."'>
					      <input type='hidden' name='stock' value='".$data['stock']."'>
					      </form>";
						}
				 echo "</tbody></table></div>";
				}
			pie();
		}
		else if ($_SESSION['tipo']=="admin"){	
			include('funciones_admin.php');
			echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";
			cabecera('');
			echo "</div>";

		if (!isset($_POST["boton"]) || $_POST['genero']==0){
			echo "<div class='container'>";
			echo '<div class="form-group">';
			echo "<form method='post' action='productos.php'>";
			echo '<select class="form-control col-3" name="genero">';

			echo "<option value='0'>Todos</option>";
			while ($valores=mysqli_fetch_array($resultado_genero)){
				echo "<option value='".$valores[0]."'>".$valores[1]."</option>";

			}

			echo "</select>";
			echo "<input type='submit' class='btn btn-primary' name='boton' value='Filtrar'>";
			echo "</form>";
			echo "</div>";
			echo "</div>";

			$sql="select familia.nombre as fam, producto.nombre, producto.cod, producto.nombre_corto, producto.pvp, producto.stock from producto, familia where familia.cod=producto.familia";
			$resultado = mysqli_query($conexion, $sql);
			echo "<div class='container'><table class='table table-striped'><thead><tr>
			        <th>Nombre disco</th>
			        <th>Artista</th>
			        <th>Precio</th>
			        <th>Genero</th>
			        <th>Unidades</th>
			        <th>Stock</th>
			        <th>Comprar</th>
			        <th>Imagen</th>
			      </tr></thead>";

			    while ($datos=mysqli_fetch_assoc($resultado))
			    {
				echo "<tbody><tr>
					        <td>".$datos['nombre']."</td>
					        <td>".$datos['nombre_corto']."</td>
					        <td>".$datos['pvp']." €</td>
					        <td>".$datos['fam']."</td>
					        <form method='post' action='cesta.php'>
					        <td><input type=\"number\" name=\"unid\" min=\"1\" max=\"".$datos['stock']."\" value=\"1\"></td>
					        <td>".$datos['stock']."</td>
					        <td><input type='submit' class='btn btn-primary' name='comprar' value='Comprar'></td>
					        <td><i class=\"fa fa-file-image-o\" style=\"font-size:24px\"></i></td>
					      </tr>
					       <input type='hidden' name='nombre' value='".$datos['nombre']."'>
					      <input type='hidden' name='cod' value='".$datos['cod']."'>
					      <input type='hidden' name='artista' value='".$datos['nombre_corto']."'>
					      <input type='hidden' name='precio' value='".$datos['pvp']."'>
					      <input type='hidden' name='stock' value='".$datos['stock']."'>
					      </form>";
			    }
			    echo "</tbody></table></div>";
				
			}
		else{
			$genero=$_POST["genero"];
			$consulta="select familia.nombre as fam, producto.nombre, producto.cod, producto.nombre_corto, producto.pvp, producto.stock from producto, familia where familia.cod=producto.familia and producto.familia='".$genero."'";
				$resultado2 = mysqli_query($conexion, $consulta);
			echo "<div class='container'>";
				echo '<div class="form-group">';
				echo "<form method='post' action='productos.php'>";
				echo '<select class="form-control col-3" name="genero">';

				echo "<option value='0'>Todos</option>";
				while ($valores=mysqli_fetch_array($resultado_genero)){
					if ($genero == $valores[0]) {
						echo "<option value='".$valores[0]."' selected>".$valores[1]."</option>";
					}
					else{
					echo "<option value='".$valores[0]."'>".$valores[1]."</option>";
					}
				}

				echo "</select>";
				echo "<input type='submit' class='btn btn-primary' name='boton' value='Filtrar'>";
				echo "</form>";
				echo "</div>";
				echo "</div>";
				
				
				echo "<div class='container'><table class='table table-striped '><thead><tr>
			        <th>Nombre disco</th>
			        <th>Artista</th>
			        <th>Precio</th>
			        <th>Genero</th>
			        <th>Unidades</th>
			        <th>Stock</th>
			        <th>Comprar</th>
			        <th>Imagen</th>
			      </tr></thead>";
				while ($data=mysqli_fetch_assoc($resultado2)){
					echo "<tbody><tr>
					        <td>".$data['nombre']."</td>
					        <td>".$data['nombre_corto']."</td>
					        <td>".$data['pvp']." €</td>
					        <td>".$data['fam']."</td>
					        <form method='post' action='cesta.php'>
					        <td><input type=\"number\" name=\"unid\" min=\"1\" max=\"".$data['stock']."\" value=\"1\"></td>
					        <td>".$data['stock']."</td>
					        <td><input type='submit' class='btn btn-primary' name='comprar' value='Comprar'></td>
					        <td><i class=\"fa fa-file-image-o\" style=\"font-size:24px\"></i></td>
					      </tr>
					      <input type='hidden' name='nombre' value='".$data['nombre']."'>
					      <input type='hidden' name='cod' value='".$data['cod']."'>
					      <input type='hidden' name='artista' value='".$data['nombre_corto']."'>
					      <input type='hidden' name='precio' value='".$data['pvp']."'>
					      <input type='hidden' name='stock' value='".$data['stock']."'>
					      </form>";
						}
				 echo "</tbody></table></div>";
				}
			pie();
		}
	}

mysqli_close($conexion);
?>