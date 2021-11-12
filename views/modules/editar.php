<?php

	session_start();

	if(!$_SESSION["validar"]){
		header("location:index.php?action=ingresar");
		exit();
	}

?>

<h1>EDITAR USUARIO</h1>

<form method="post" onsubmit="return validarCambio()">
	
<?php

$editarUsuario = new MvcController();
$editarUsuario -> editarUsuarioController();
$editarUsuario -> actualizarUsuarioController();

?>

</form>