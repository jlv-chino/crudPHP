<h1>INGRESAR</h1>

	<form method="post" onsubmit="return validarIngreso()">
		
		<input type="text" placeholder="Usuario" name="usuarioIngreso" id="usuarioIngreso" maxlength="6" required>

		<input type="password" placeholder="Contraseña" name="passwordIngreso" id="passwordIngreso" minlength="6" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>

		<input type="submit" value="Enviar">

	</form>

	<?php

		$ingreso = new MvcController();
		$ingreso->ingresoUsuarioController();

		if(isset($_GET['action'])){

			if($_GET['action'] == "fallo"){
	
				echo "Error al ingresar !!!";
	
			}
	
		}

	?>