<!doctype html>
<html lang="es">
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="css/signin.css">
</head>
<body>
<?php
include 'conexion.php';

if (isset($_POST['mail'])) {
    $mailu = $_POST['mail'];
    if (!filter_var($mailu, FILTER_VALIDATE_EMAIL)) {
        echo "<script>   
            swal({text: 'Correo inválido', title: 'Error', icon: 'error',}).then((value) => {
            window.location = 'index.php';
            });
            </script>";
        exit;
    } else {
        $sql = "SELECT * FROM users_coord WHERE email = '$mailu'";
        $datos = $con->query($sql);
        if ($datos->num_rows == 0) {
            echo "<script>   
            swal({text: 'Correo no registrado', title: 'Error', icon: 'error',}).then((value) => {
            window.location = 'index.php';
            });
            </script>";
            exit;
        } else {
            $row = $datos->fetch_assoc();
            $nom = $row['nombres'];
            $apel = $row['apellidos'];
            $estado = $row['estado'];
            $pass = $row['pass'];
            if ($estado === 'I') {
                echo "<script>   
            swal({text: 'Usuario inactivo', title: 'Error', icon: 'error',}).then((value) => {
            window.location = 'index.php';
            });
            </script>";
                exit;
            } else {
            // notificar por correo usuario y contraseña
            include 'sendmail.php';
            recovery_cta($nom." ".$apel, $pass, $mailu);
            echo "<script>   
            swal({text: 'Mensaje enviado ...!!!', title: 'Olimpiadas Maths', icon: 'success',}).then((value) => {
            window.location = 'index.php';
            });
            </script>";
            }
        }
    }
}
?>
</body>
</html>
<style>
.swal-text{
    padding: 17px;
    display: block;
    margin: 22px;
    text-align: center;
    font-size: large;
    color: #61534e;
    font-family: Arial, Helvetica, sans-serif;
}

.swal-title {
    font-family: Arial, Helvetica, sans-serif;
}

.swal-button {
        color: black !important;
    }
</style>