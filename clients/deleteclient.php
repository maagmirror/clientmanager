<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

require dirname(__FILE__) . "/../db_connect.php";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['id'])){

    $id = $_POST['id'];

    $sql = "DELETE FROM clients WHERE ID=$id"; 

    if ($con->query($sql) === TRUE) {
        echo "Se ha eliminado correctamente el cliente";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

	$con->close();

    //header('Location: home.php?message=deleteOK');
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=deleteOK');

}