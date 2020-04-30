<?php
require 'uploader/Uploader.php';
require 'uploader/Adapters/AdapterInterface.php';
require 'uploader/Adapters/Base64.php';
require 'uploader/Adapters/Psr7.php';
require 'uploader/Adapters/Upload.php';
require 'uploader/Adapters/Url.php';
require ("db_connect.php");

use Uploader\Uploader;

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// $location = __DIR__ . '/../img/clients';

// compressedImage($_FILES['clientpreview']['tmp_name'],$location,60);

// function compressedImage($source, $path, $quality) {

//     $info = getimagesize($source);

//     if ($info['mime'] == 'image/jpeg') 
//         $image = imagecreatefromjpeg($source);

//     elseif ($info['mime'] == 'image/gif') 
//         $image = imagecreatefromgif($source);

//     elseif ($info['mime'] == 'image/png') 
//         $image = imagecreatefrompng($source);

//     imagejpeg($image, $path, $quality);

// }

$uploader = new Uploader('.');

$uploads_dir = __DIR__ . '/../img/clients';

$upload = $uploader->with($_FILES['clientpreview'])  // Agrega la imagen
    ->setFilename($_FILES['clientpreview']['name'])  // Nombre de archivo = md5(id del usuario)
    ->setOverwrite(true)                             // Sobreescribe en caso de existir
    ->setDirectory($uploads_dir)
    ->setCreateDir(true)                             // Crea el directorio en caso de no existir
    ->setExtension("jpeg");                           // Coloca la extension .jpg por defecto

try {
    $upload->save();                                 //Sube la imagen
} catch (Exception $e) {                             //Error
    $message = $e->getMessage();
    die(json_encode([
        'codigo' => 22,
        'error' => 'Error al intentar subir la imagen',
        'metadata' => $message
    ]));
}

$clientimg = $_FILES['clientpreview']['name'].".jpeg";

// para editar un cliente existente

if (isset($_POST['id'])){

    $id = $_POST['id'];

    $sql = "DELETE FROM clients WHERE ID=$id"; 

    if ($con->query($sql) === TRUE) {
        echo "Se ha ingresado correctamente el cliente";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    
    $client = $_POST['clientname'];

    $url = $_POST['clienturl'];

	$clientdescription = $_POST['clientdescription'];

    $sql = "INSERT INTO clients (id,clientname, clientpreview, clientdescription, clienturl)
    VALUES ('$id', '$client', '$clientimg', '$clientdescription', '$url')";

    if ($con->query($sql) === TRUE) {
        echo "Se ha ingresado correctamente el cliente";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

	$con->close();

	header('Location: home.php?message=editOK');
	

} else{

    $client = $_POST['clientname'];

    $url = $_POST['clienturl'];

	$clientdescription = $_POST['clientdescription'];

    $sql = "INSERT INTO clients (clientname, clientpreview, clientdescription, clienturl)
    VALUES ('$client', '$clientimg', '$clientdescription', '$url')";

    if ($con->query($sql) === TRUE) {
        echo "Se ha ingresado correctamente el cliente";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

	$con->close();

	header('Location: home.php?message=SubidaOK');

}
