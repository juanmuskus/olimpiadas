<?php session_start();
if (isset($_SESSION['usuario'])) {
    $us = $_SESSION['usuario'];
    $tipo = $_SESSION['tipo'];
    $mail = $_SESSION['mail'];
} else {
    echo "<title>Error</title>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css'>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>";
    echo "<div style='margin: 20px 20px 20px 20px;'><div class='alert alert-danger' role='alert'>";
    echo "Ud no posee acceso al sistema !!!";
    echo "<hr><a href='index.php'><button class='btn btn-danger'><i class='bi bi-box-arrow-in-left'> </i>Login</button></a></div></div>";
    die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<?php
include('conexion.php');
$id = $_REQUEST['id'];
$cant_est = $_REQUEST['estudiantes'];
//actualizar coordinador
$sql = "UPDATE users_coord SET estado ='A', cant_est = $cant_est WHERE docidentidad = $id";
$con->query($sql);
//notificar por correo
include 'sendmail.php';
$sql_coord = "SELECT * FROM users_coord WHERE docidentidad = $id";
$res_coord = $con->query($sql_coord);
$row_coord = $res_coord->fetch_assoc();
$nom = $row_coord['nombres'];
$apel = $row_coord['apellidos'];
$mail = $row_coord['email'];
$pass = $row_coord['pass'];
notificar_cta($nom." ".$apel, $id, $mail);
echo "<script>
    swal({text: 'Coordinador habilitado con éxito', title: 'Olimpiadas Maths',}).then((value) => {
    window.location= 'coord.php';
    });
</script>";
$con->close();
// se debe enviar un correo al coordinador informando que ha sido habilitado con sus credenciales y link de acceso 

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