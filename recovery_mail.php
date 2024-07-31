<!doctype html>
<html lang="es">
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="css/signin.css">
</head>
<body>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


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
        $mail = new PHPMailer(true);
        try {
            $mail->Host       = 'smtp.mail.yahoo.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'juanmuskus@yahoo.com';
            $mail->Password   = 'jrkquldloxmjjydv';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
                
            //Recipients
            $mail->setFrom('cbanquet@correo.unicordoba.edu.co', 'Coord. Olimpiadas Maths');
            $mail->addAddress(trim($mailu," "));     
            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'Olimpiadas Maths - Unicórdoba';
            $mail->Body    = "<html><body style=' font-family: tahoma;'><p>Hola,<b> ".trim($nom," ")." ".trim($apel," ")." </b></p><p>Ha solicitado recuperar la contraseña de su cuenta en la web de las Olimpiadas de Matemáticas - Universidad de Córdoba. Su contraseña es: <b>".$pass."</b></p><p>Por favor, haga marca esta contraseña como confidencial y no la comparta con nadie.</p></body></html>";
        
            $mail->send();
            echo "<script>   
            swal({text: 'Mensaje enviado ...!!!', title: 'Olimpiadas Maths', icon: 'success',}).then((value) => {
            window.location = 'index.php';
            });
            </script>";
            
        } catch (Exception $e) {
            echo "No se pudo enviar el correo. Mail Error: {$mail->ErrorInfo}";
        }
        $mail->SmtpClose();  
    }
    }
    }
}
?>
</body>
</html>
