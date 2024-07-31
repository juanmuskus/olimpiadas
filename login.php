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
$mail=$_POST['mail'];
$pass=$_POST['pass'];
// verificar si existe el usuario
$existe_u=$con->query("select * from users_coord where email = '$mail'");
$cant= $existe_u->num_rows;
    if ($cant > 0){ // sabemos que existe el usuario guardo el pass para comparar
        foreach($existe_u as $p)
        $rpass=$p['pass'];
        $nombre=$p['nombres'];
        $apellido=$p['apellidos'];
        $tipo=$p['tipo'];
        $cant_est = $p['cant_est'];
        $id_ies = $p['IES_idIES'];
        //comparo
        if ($rpass==$pass){ 
            session_start();
            $_SESSION['usuario']=$nombre.' '.$apellido;
            $_SESSION['tipo']=$tipo;
            $_SESSION['cant_est']=$cant_est;
            $_SESSION['id_ies']=$id_ies;
            $_SESSION['mail']=$mail;
            header('location:main.php');    
        }
        else {
            echo "<script>   
            swal({text: 'Password errado ...!!!', title: 'Olimpiadas Maths',}).then((value) => {
            window.location= 'index.php';
            });
            </script>";
            }
        }  
    else echo "<script>   
    swal({text: 'El e-mail no existe ...!!!',title: 'Olimpiadas Maths',}).then((value) => {
    window.location= 'index.php';
    });
    </script>";
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