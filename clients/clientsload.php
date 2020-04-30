<?php

require "db_connect.php";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = "SELECT * FROM clients ORDER BY id DESC";

$result = $con->query($sql);

$arrResult = $result->fetch_all();

$con->close();

?>