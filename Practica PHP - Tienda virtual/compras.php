<?php
session_start();


$conexion = mysqli_connect("localhost","root","","fernandisco" )or die ("No se pudo conectar");
mysqli_set_charset($conexion, "utf8");
$clientes = "select * from clientes";
$resultado_clientes=mysqli_query($conexion, $clientes);
if (isset($_SESSION['tipo'])) {

	if ($_SESSION['tipo']=="usuario"){	
			include('funciones_login.php');
			echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";
			cabecera('');
			echo "</div>";		

			$sql="SELECT pedidos.NUM_PEDIDO, pedidos.DNI, pedidos.FECHA, lineas.producto, lineas.precio
				FROM pedidos, lineas
				WHERE pedidos.NUM_PEDIDO = lineas.NUM_PEDIDO
				and pedidos.DNI='".$_SESSION['dni']."'";
			$resultado = mysqli_query($conexion, $sql);
			echo "<div class='container'><table class='table table-striped'><thead><tr>
			        <th>Numero Pedido</th>
			        <th>DNI cliente</th>
			        <th>Fecha pedido</th>
			        <th>Nombre</th>
			        <th>Precio</th>
			      </tr></thead>";

			    while ($datos=mysqli_fetch_assoc($resultado))
			    {
				echo "<tbody><tr>
					        <td>".$datos['NUM_PEDIDO']."</td>
					        <td>".$datos['DNI']."</td>
					        <td>".$datos['FECHA']."</td>
					        <td>".$datos['producto']."</td>					       
					        <td>".$datos['precio']." €</td>
					      </tr>";
			    }
			    echo "</tbody></table></div>";
				
			}		
		else if ($_SESSION['tipo']=="admin"){	
			include('funciones_admin.php');
			echo "<h1>FernanDISCO <img src='img/man.png'> </h1>";
			cabecera('');
			echo "</div>";

		if (!isset($_POST["boton"]) || $_POST['cliente']==0){
			echo "<div class='container'>";
			echo '<div class="form-group">';
			echo "<form method='post' action='compras.php'>";
			echo '<select class="form-control col-3" name="cliente">';

			echo "<option value='0'>Todos</option>";
			while ($valores=mysqli_fetch_assoc($resultado_clientes)){
				echo "<option value='".$valores["DNI"]."'>".$valores["DNI"]." - ".$valores["NOMBRE"]."</option>";

			}

			echo "</select>";
			echo "<input type='submit' class='btn btn-primary' name='boton' value='Filtrar'>";
			echo "</form>";
			echo "</div>";
			echo "</div>";

			$sql="SELECT pedidos.NUM_PEDIDO, pedidos.DNI, pedidos.FECHA, lineas.producto, lineas.precio
				FROM pedidos, lineas
				WHERE pedidos.NUM_PEDIDO = lineas.NUM_PEDIDO";
			$resultado = mysqli_query($conexion, $sql);
			echo "<div class='container'><table class='table table-striped'><thead><tr>
			        <th>Numero Pedido</th>
			        <th>DNI cliente</th>
			        <th>Fecha pedido</th>
			        <th>Nombre</th>
			        <th>Precio</th>
			      </tr></thead>";

			    while ($datos=mysqli_fetch_assoc($resultado))
			    {
				echo "<tbody><tr>
					        <td>".$datos['NUM_PEDIDO']."</td>
					        <td>".$datos['DNI']."</td>
					        <td>".$datos['FECHA']."</td>
					        <td>".$datos['producto']."</td>					       
					        <td>".$datos['precio']." €</td>
					          </tr>";
			    }
			    echo "</tbody></table></div>";
				
			}
		else{
			$cliente=$_POST["cliente"];
			$consulta="SELECT pedidos.NUM_PEDIDO, pedidos.DNI, pedidos.FECHA, lineas.producto, lineas.precio
				FROM pedidos, lineas
				WHERE pedidos.NUM_PEDIDO = lineas.NUM_PEDIDO
				and pedidos.DNI='".$cliente."'";
				$resultado2 = mysqli_query($conexion, $consulta);
					echo "<div class='container'>";
					echo '<div class="form-group">';
					echo "<form method='post' action='compras.php'>";
					echo '<select class="form-control col-3" name="cliente">';

					echo "<option value='0'>Todos</option>";
				while ($valores=mysqli_fetch_assoc($resultado_clientes)){
				
					if ($cliente==$valores["DNI"]) {
						echo "<option value='".$valores["DNI"]."' selected>".$valores["DNI"]." - ".$valores["NOMBRE"]."</option>";
					}else{
						echo "<option value='".$valores["DNI"]."'>".$valores["DNI"]." - ".$valores["NOMBRE"]."</option>";
					}
				}

				echo "</select>";
				echo "<input type='submit' class='btn btn-primary' name='boton' value='Filtrar'>";
				echo "</form>";
				echo "</div>";
				echo "</div>";
				
				
				echo "<div class='container'><table class='table table-striped'><thead><tr>
			        <th>Numero Pedido</th>
			        <th>DNI cliente</th>
			        <th>Fecha pedido</th>
			        <th>Nombre</th>
			        <th>Precio</th>
			      </tr></thead>";

			    while ($datos=mysqli_fetch_assoc($resultado2))
			    {
				echo "<tbody><tr>
					        <td>".$datos['NUM_PEDIDO']."</td>
					        <td>".$datos['DNI']."</td>
					        <td>".$datos['FECHA']."</td>
					        <td>".$datos['producto']."</td>					       
					        <td>".$datos['precio']." €</td>
					          </tr>";
			    }
			    echo "</tbody></table></div>";
				}
			pie();
		}
	}

mysqli_close($conexion);
?>