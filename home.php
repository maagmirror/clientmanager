<?php

$pagename = "Inicio";

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

?>

<!DOCTYPE html>
<html>
	<?php require "template/header.php";?>
	<body class="loggedin">
		<?php require "template/nav.php";?>
		<div class="content text-center">

			<h3 class="welcome-text">Bienvenido, <?=username?>!</h3>

			<h2>Por favor selecciona una opción para continuar</h2>
			
			<div>
				<button class="button-area-limpia btn-add-client btn-home">
					Agregar Cliente
				</button>
			</div>

			<div id="modal-add-client" class="modal" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Rellena los datos</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="saveclient.php" method="POST" enctype="multipart/form-data">
								<!-- <input name="id" type="hidden" value="1"> -->

								<div class="form-group">
									<label for="clientname">Nombre de el cliente</label>
									<input required name="clientname" type="text" class="form-control" id="clientname" placeholder="Nombre del cliente">
								</div>

								<div class="form-group">
									<label for="clienturl">URL de la página web</label>
									<input required name="clienturl" type="text" class="form-control" id="clienturl" placeholder="https://example.fabicorp">
								</div>

								<div class="form-group">
									<label for="clientpreview">Agrega una preview de la página</label>
									<input required name="clientpreview" type="file" class="form-control-file text-center" id="clientpreview">
								</div>

								<div class="form-group">
									<label for="clientdescription">Breve descripcion del proyecto</label>
									<textarea required name="clientdescription" class="form-control" id="clientdescription" rows="3"></textarea>
								</div>

								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Guardar Datos</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</body>
</html>