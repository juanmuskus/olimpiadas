<!doctype html>
<html lang="es">
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="css/signin.css">
</head>
<body>
<?php
use Mailgun\Mailgun;
//Load Composer's autoloader
require 'vendor/autoload.php';
include 'conexion.php';

if (isset($_POST['mail'])){
    $mailu = $_POST['mail'];
    if (!filter_var($mailu, FILTER_VALIDATE_EMAIL)) {
    echo "<script>   
            swal({text: 'Correo inválido', title: 'Error', icon: 'error',}).then((value) => {
            window.location = 'index.php';
            });
            </script>";
    exit;
}
else {
$sql = "SELECT * FROM users_coord WHERE email = '$mailu'";
$datos = $con->query($sql);
if ($datos->num_rows == 0) {
    echo "<script>   
            swal({text: 'Correo no registrado', title: 'Error', icon: 'error',}).then((value) => {
            window.location = 'index.php';
            });
            </script>";
    exit;
}
else {
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
    } 
    else {
    $mg = Mailgun::create('01b89aa64b6ff724d7aef0a7beb2e594-8a084751-d63f376f'); // For US servers
    $mg->messages()->send("olimpiadas.unicordoba.edu.co", [
    'from'    => 'eventos.unicor@gmail.com',
    'to'      => $mailu,
    'subject' => 'Olimpiadas Maths - Unicórdoba',
    'text'    => 'It is so simple to send a message.'
    ]);
    //$mail->MsgHTML("<html><body style=' font-family: tahoma;'><p>Hola,<b> ".trim($nom," ")." ".trim($apel," ")." </b></p><p>Ha solicitado recuperar la contraseña de su cuenta en la web de las Olimpiadas de Matemáticas - Universidad de Córdoba. Su contraseña es: <b>".$pass."</b></p><p>Por favor, haga marca esta contraseña como confidencial y no la comparta con nadie.</p></body></html>");    
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
