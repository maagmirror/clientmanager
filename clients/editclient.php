<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

require dirname(__FILE__) . "/../db_connect.php";
require dirname(__FILE__) . "/../uploader/Uploader.php";
require dirname(__FILE__) . "/../uploader/Adapters/AdapterInterface.php";
require dirname(__FILE__) . "/../uploader/Adapters/Base64.php";
require dirname(__FILE__) . "/../uploader/Adapters/Psr7.php";
require dirname(__FILE__) . "/../uploader/Adapters/Upload.php";
require dirname(__FILE__) . "/../uploader/Adapters/Url.php";

use Uploader\Uploader;

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


// para editar un cliente existente

if (isset($_POST['idclient'])){

    if (!empty($_FILES['clientpreview']['name'])){

        $uploader = new Uploader('.');

        $uploads_dir = __DIR__ . '/../../img/clients';

        $upload = $uploader->with($_FILES['clientpreview'])  // Agrega la imagen
            ->setFilename($_FILES['clientpreview']['name'])  // Nombre de archivo = md5(id del usuario)
            ->setOverwrite(true)                             // Sobreescribe en caso de existir
            ->setDirectory($uploads_dir)
            ->setCreateDir(true)                             // Crea el directorio en caso de no existir
            ->setExtension("jpg");                           // Coloca la extension .jpg por defecto

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

        $clientimg = $_FILES['clientpreview']['name'].".jpg";
    }

    $id = $_POST['idclient'];
    
    $client = $_POST['clientname'];

    $url = $_POST['clienturl'];

    $clientdescription = $_POST['clientdescription'];
    
    if (empty($_FILES['clientpreview']['name'])){
        $sql = "UPDATE clients SET 
            clientname = '".$client."',
            clientdescription = '".$clientdescription."',
            clienturl = '".$url."'
        WHERE id = '".$id."'";

        if ($con->query($sql) === TRUE) {
            echo "Se ha editado correctamente el cliente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }

        $con->close();

    }else{
        $sql = "UPDATE clients SET 
            clientname = '".$client."',
            clientdescription = '".$clientdescription."',
            clientpreview = '".$clientimg."',
            clienturl = '".$url."'
        WHERE id = '".$id."'";

        if ($con->query($sql) === TRUE) {
            echo "Se ha editado correctamente el cliente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }

        $con->close();
    }

	header('Location: ' . '/panel/clients.php' . '?message=editOK');

}

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title> Editando... </title>
        <link href="/./panel/css/styles.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/./panel/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">

        <script src="/./panel/js/jquery.js"></script>
        <script src="/./panel/js/bootstrap.js"></script>
        <script src="/./panel/js/script.js"></script>
    </head>
	<body class="loggedin">
        <?php // require dirname(__FILE__) . "/../template/nav.php";?>
    </body>
</html>

<script>
    $( document ).ready(function() {
        $('#modal-add-client').modal('show');
    });
</script>

<div id="modal-add-client" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rellena los datos</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input name="idclient" type="hidden" value="<?php echo $_POST['id'] ?>">

                    <div class="form-group">
                        <label for="clientname">Nombre de el cliente</label>
                        <input required name="clientname" type="text" class="form-control" id="clientname" placeholder="Nombre del cliente" value="<?php echo $_POST['name'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="clienturl">URL de la página web</label>
                        <input required name="clienturl" type="text" class="form-control" id="clienturl" placeholder="https://example.fabicorp" value="<?php echo $_POST['web'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="clientpreview">Agrega una preview de la página</label>
                        <input name="clientpreview" type="file" class="form-control-file text-center" id="clientpreview">
                    </div>

                    <div class="form-group">
                        <label for="clientdescription">Breve descripcion del proyecto</label>
                        <textarea required name="clientdescription" class="form-control" id="clientdescription" rows="3"><?php echo $_POST['desc'] ?></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Datos</button>
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
