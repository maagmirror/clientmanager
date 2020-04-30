<?php

$pagename = "Registro de usuarios";

require "db_connect.php";

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// if ( !isset($_POST['username'], $_POST['password'], $_POST['email']) ) {
// 	// Could not get the data that should have been sent.
// 	exit('Please fill both the username and password fields!');
// }

if (isset($_POST['username'],$_POST['email'],$_POST['password'])) {
    $password = hash('sha256', $_POST['password']);

    $username = $_POST['username'];

    $email = $_POST['email'];

    $sql = "INSERT INTO $DATABASE_TABLE (username, password, email)
    VALUES ('$username', '$password', '$email')";

    if ($con->query($sql) === TRUE) {
        echo "Se ha registrado el usuario $username";
    } else {
		header('Location: index.php?message=registroErr');
    }

	$con->close();

	header('Location: index.php?message=registroOk');

}

?>

<!DOCTYPE html>
<html>
	<?php require "template/header.php";?>
	<body>
	<?php require "template/nav.php";?>
		<div class="login">
			<h1>Registrar Usuario</h1>
			<form action="signup.php" method="post">
				<div class="form-group">
					<label for="username">
						<i class="fas fa-user icon-form"></i>
					</label>
					<input type="text" name="username" placeholder="Usuario" id="username" required>
				</div>

				<div class="form-group">
					<label for="email">
						<i class="fas fa-envelope icon-form"></i>
					</label>
					<input type="email" name="email" placeholder="email" id="email" required>
				</div>

				<div class="form-group">
					<label for="password">
						<i class="fas fa-lock icon-form"></i>
					</label>
					<input type="password" name="password" placeholder="Contraseña" id="password" required>
				</div>
				<input type="submit" value="Registrar">
			</form>
		</div>
	</body>
</html>