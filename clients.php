<?php

$pagename = "Clientes";

require "clients/clientsload.php";

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
		<div class="content">
			<h2 class="text-center">Clientes en DB</h2>
			<div>
				<p class="text-center">Todos los clientes</p>
				<table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Página Web</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($arrResult as $a){ 
                            echo "<tr>";
                                echo "<td>";
                                echo $a[0];
                                echo "</td>";
                                echo "<td class='profile-passwd'>";
                                echo $a[1];
                                echo "</td>";
                                echo "<td>";
                                echo "<a target='_blank' href='https://nibiru.com.uy/img/clients/" . $a[2] . "'>";
                                echo "<img width='50px' src='https://nibiru.com.uy/img/clients/" . $a[2] . "'><br>Ver Foto</a>";
                                echo "</td>";
                                echo "<td class='profile-passwd'>";
                                echo $a[3];
                                echo "</td>";
                                echo "<td class='profile-passwd'>";
                                echo $a[4];
                                echo "</td>";
                                echo "<td>";
                                    echo "<form action='clients/deleteclient.php' method='POST'>";
                                        echo "<input type='hidden' name='id' value='". $a[0] ."'>";
                                        echo "<button class='btn btn-danger' type='submit'>eliminar</button>";
                                    echo "</form>";
                                    echo "<form action='clients/editclient.php' method='POST'>";
                                        echo "<input type='hidden' name='id' value='". $a[0] ."'>";
                                        echo "<input type='hidden' name='name' value='". $a[1] ."'>";
                                        echo "<input type='hidden' name='desc' value='". $a[3] ."'>";
                                        echo "<input type='hidden' name='web' value='". $a[4] ."'>";
                                        echo "<button class='btn btn-info' type='submit'>editar</button>";
                                    echo "</form>";
                                echo "</td>";
                            echo "</tr>";
                        }?>
                    </tbody>
                </table>
			</div>
		</div>
	</body>
</html>