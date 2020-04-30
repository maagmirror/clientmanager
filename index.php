<?php
$pagename = "Login";

require "template/messages.php";

if (isset($_GET['message'])){
	$message = $mensaje[$_GET['message']];
}

?>

<!DOCTYPE html>
<html>
	<?php require "template/header.php";?>
	<body style="background-color:#3e5388;">
		<?php
		if (isset($message)){
			include "template/notification.php";
		}
		?>
		<div class="login">
			<img style="display:block;margin-left:auto;margin-right:auto;width:50%;padding-top:15px;" src="https://www.nibiru.com.uy/img/logo-transparent.png">
			<form action="authenticate.php" method="post">
				<div class="form-group">
					<label for="username">
						<i class="fas fa-user icon-form"></i>
					</label>
					<input type="text" name="username" placeholder="Usuario" id="username" required>
				</div>

				<div class="form-group">
					<label for="password">
						<i class="fas fa-lock icon-form"></i>
					</label>
					<input type="password" name="password" placeholder="Contraseña" id="password" required>
				</div>
				<input type="submit" value="Ingresar">
			</form>
		</div>
	</body>
</html>