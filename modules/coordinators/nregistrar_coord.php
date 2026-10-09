<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $us = $_SESSION['usuario'];
    $tipo = $_SESSION['tipo'];
    $mail = $_SESSION['mail'];
    $id_ies=$_SESSION['id_ies'];
    $cant_est=$_SESSION['cant_est'];
} else {
    echo "<title>Error</title>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css'>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>";
    echo "<div style='margin: 20px 20px 20px 20px;'><div class='alert alert-danger' role='alert'>";
    echo "Ud no posee acceso al sistema !!!";
    echo "<hr><a href='../../index.php'><button class='btn btn-danger'><i class='bi bi-box-arrow-in-left'> </i>Login</button></a></div></div>";
    die();
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <base href="../../">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<?php 
require dirname(__DIR__, 2) . '/modules/shared/conexion.php';
$doci = $_POST['doci'];
$nom = strtoupper($_POST['nom']);
$apel = strtoupper($_POST['apel']);
$mail = $_POST['cmail'];
$pass = md5($doci);
$estado = 'I';
$tipo = 'C';
$can_est = 0;
$idies = $_POST['lies'];
$nit = $_POST['nit'];
$lugar = $_POST['lugar'];

$sql_evaldoci = "SELECT * FROM users_coord WHERE (docidentidad = $doci) or (email = '$mail')";
$res_evaldoci = $con->query($sql_evaldoci);
$filas = mysqli_num_rows($res_evaldoci);
if ($filas > 0) {
    echo "<script>   
    swal({text: 'Ya existe un coordinador registrado con este numero de documento o correo: ".$doci." / ".$mail."', title: 'Olimpiadas Maths',}).then((value) => {
    window.location= 'modules/coordinators/coord.php';
    });
    </script>";
} else {
    $sql = "INSERT INTO users_coord (docidentidad, nombres, apellidos, email, pass, estado, tipo, cant_est, nit, lugar, IES_idIES) VALUES ($doci, '$nom', '$apel', '$mail', '$pass', '$estado', '$tipo', $can_est, '$nit', '$lugar', $idies)";
    $con->query($sql);
    echo "<script>   
    swal({text: 'Coordinador registrado con éxito !!!', title: 'Olimpiadas Maths',}).then((value) => {
    window.location= 'modules/coordinators/coord.php';
    });
    </script>";
}
$con->close();

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