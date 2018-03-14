<?php
function cabecera($texto) 
{
    print "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>FernanDISCO</title>
   <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css\">
   <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">
  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js\"></script>
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js\"></script>
  <link href=\"css/miestilo.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>

<body>
<div id='envoltorio'>
<div id='cabecera'>
		<div id='titulo'>
			$texto
		</div>
	</div>


<div id=\"menu\">
<ul>
   <font size=1>
   <li><a href=\"index.php\">Inicio</a></li>
  <li><a href=\"login.php\">Iniciar sesion</a></li>
  <li><a href=\"productos.php\">Ver productos</a></li>  </font>
</ul>  
</div>


</div>";
}

function pie() 
{
    print '</div>

<div id="pie">
<address>
2- D.A.W. 
</address>

</div>
</body>
</html>';
}
