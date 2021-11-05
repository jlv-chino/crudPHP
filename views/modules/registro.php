<h1>REGISTRO DE USUARIO</h1>

<form method="POST" onsubmit="return validarRegistro()">
	
	<label for="usuarioRegistro">Nombre: </label>
	<input type="text" placeholder="Máximo 6 caracteres" name="usuarioRegistro" id="usuarioRegistro" maxlength="6" required>

	<label for="passwordRegistro">Password: </label>
	<input type="password" placeholder="Mínimo de 6 caracteres, incluir número/s y una mayúscula" name="passwordRegistro" id="passwordRegistro" minlength="6" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>

	<label for="emailRegistro">Email: </label>
	<input type="email" placeholder="Escriba su email" name="emailRegistro" id="emailRegistro" required>

	<p><input type="checkbox" id="terminos"><a href="#">Acepto términos y condiciones</a></p>

	<input type="submit" value="Enviar">

</form>

<?php

	$registro = new MvcController();
	$registro->registroUsuarioController();

	if(isset($_GET['action'])){

		if($_GET['action'] == "ok"){

			echo "Registro exitoso !!!";

		}

	}

?>