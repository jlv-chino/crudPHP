<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Template</title>

	<link rel="stylesheet" type="text/css" href="css/estilos.css">

	<script src="views/js/jquery-3.6.0.min.js"></script>

</head>

<body>

<?php include "modules/navegacion.php"; ?>


<section>

<?php 

$mvc = new MvcController();
$mvc->enlacesPaginasController();

 ?>

</section>

<script src="views/js/validarRegistro.js"></script>
<script src="views/js/validarIngreso.js"></script>
<script src="views/js/validarCambio.js"></script>
	
</body>

</html>