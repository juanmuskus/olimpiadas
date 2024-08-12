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
$doci = $_POST['doci'];
$nom = $_POST['nom'];
$apel = $_POST['apel'];
$mail = $_POST['cmail'];
$pass = md5($doci);
$estado = 'I';
$tipo = 'C';
$can_est = 0;
$idies = $_POST['lies'];

$sql_evaldoci = "SELECT * FROM users_coord WHERE docidentidad = $doci";
$res_evaldoci = $con->query($sql_evaldoci);
$filas = mysqli_num_rows($res_evaldoci);
if ($filas > 0) {
    echo "<script>   
    swal({text: 'Ya existe un coordinador registrado con este numero de documento: ".$doci."', title: 'Olimpiadas Maths',}).then((value) => {
    window.location= 'login.php';
    });
    </script>";
} else {
    $sql = "INSERT INTO users_coord (docidentidad, nombres, apellidos, email, pass, estado, tipo, cant_est, IES_idIES) VALUES ($doci, '$nom', '$apel', '$mail', '$pass', '$estado', '$tipo', $can_est, $idies)";
    $con->query($sql);
    echo "<script>   
    swal({text: 'Coordinador registrado con éxito !!!', title: 'Olimpiadas Maths',}).then((value) => {
    window.location= 'index.php';
    });
    </script>";
}
$con->close();
// se debe enviar un correo al coordinador informando que ha sido habilitado con sus credenciales y link de acceso 
//header('location: index.php');
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
</style>