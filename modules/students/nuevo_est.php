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
?>
<!DOCTYPE html>
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
// evaluar campos
$doci = $_POST['doci'];
$nom1 = strtoupper($_POST['nom1']);
if (!empty($_POST['nom2']))
    $nom2 = strtoupper($_POST['nom2']);
else
    $nom2 = ' ';
$ape1 = strtoupper($_POST['apel1']);
if (!empty($_POST['apel2']))
    $ape2 = strtoupper($_POST['apel2']);
else
    $ape2 = ' ';
$grado = $_POST['grado'];
$email = $_POST['estmail'];
$id_ies = $_POST['id_ies'];
// very dont exist email
$consulta = "SELECT * FROM estudiantes WHERE email = '$email'";
$resultado = mysqli_query($con, $consulta);
$filas = mysqli_num_rows($resultado);
if ($filas > 0) {
    echo "<script>   
    swal({text: 'Ya existe un estudiante con este correo: ".$email." ...!!!', title: 'Olimpiadas Maths',}).then((value) => {
    window.location= 'modules/students/main.php';
    });
    </script>";
    } else {
    $sql_doc = "SELECT * FROM estudiantes WHERE doc = $doci";
    $result_doc = mysqli_query($con, $sql_doc);
    $filas_doc = mysqli_num_rows($result_doc);
    if ($filas_doc > 0) {
        echo "<script>   
        swal({text: 'Ya existe un estudiante registrado con este numero de documento: ".$doci."', title: 'Olimpiadas Maths',}).then((value) => {
        window.location= 'modules/students/main.php';
        });
        </script>";
    } else {
        $sql_cant = "SELECT count(*) FROM estudiantes WHERE IES_idIES = $id_ies";
        $result_cant = mysqli_query($con, $sql_cant);
        $res = mysqli_fetch_array($result_cant);
        $cant = $res[0];
        if ($cant_est > $cant) {
        $sql = "INSERT INTO estudiantes (doc, nombre1, nombre2, apellido1, apellido2, grado, email, IES_idIES) VALUES ($doci, '$nom1', '$nom2', '$ape1', '$ape2', $grado, '$email', $id_ies)";
        mysqli_query($con, $sql);
            echo "<script>   
            swal({text: 'Estudiante registrado con éxito, cantidad: ".($cant+1)."/".$cant_est."', title: 'Olimpiadas Maths',}).then((value) => {
            window.location= 'modules/students/main.php';
            });
            </script>";
        } else {
            echo "<script>   
            swal({text: 'La IES solo puede registrar: ".$cant_est."  estudiantes, No puede sobrepasar esta cantidad ...!!!', title: 'Olimpiadas Maths',}).then((value) => {
            window.location= 'modules/students/main.php';
            });
            </script>";
        } 
    }
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