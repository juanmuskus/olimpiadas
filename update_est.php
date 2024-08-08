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
// update estudiante
include 'conexion.php';
$doci = $_POST['udoci'];
$nom1 = $_POST['unom1'];
if (!empty($_POST['unom2']))
    $nom2 = $_POST['unom2'];
else
    $nom2 = ' ';
$apel1 = $_POST['uapel1'];
if (!empty($_POST['uapel2']))
    $apel2 = $_POST['uapel2'];
else
    $apel2 = ' ';
$grado = $_POST['ugrado'];
$email = $_POST['uestmail'];
// verificar que no  existe email
$consulta = "SELECT * FROM estudiantes WHERE email = '$email'";
$resultado = mysqli_query($con, $consulta);
$filas = mysqli_num_rows($resultado);
if ($filas > 1) 
    echo "<script>   
    swal({text: 'Ya existe un estudiante con este correo: ".$email." ...!!!', title: 'Olimpiadas Maths',}).then((value) => {
    window.location= 'main.php';
    });
    </script>";
else {
        $sql = "UPDATE estudiantes SET nombre1='$nom1', nombre2='$nom2', apellido1='$apel1', apellido2='$apel2', grado='$grado', email='$email' WHERE doc = $doci";
        //echo $sql;
        $con->query($sql);
        echo "<script>
            swal({text: 'Estudiante actualizado con éxito', title: 'Olimpiadas Maths',}).then((value) => {
            window.location= 'main.php';
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
</style>