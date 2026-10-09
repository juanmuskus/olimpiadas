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
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

function notificar_cta($nom, $ie, $pmail){
    $mail = new PHPMailer(); // Passing `true` enables exceptions
    $mail->From = 'admin@olimpiadasmatunicordoba.com.co'; // Dirección de correo remitente
    $mail->FromName = 'Olimpiadas de Matemáticas'; // Nombre del remitente
    //principal
    $mail->AddAddress(trim($pmail)); // Dirección del destinatario y nombre
    $mail->AddReplyTo('cbanquet@correo.unicordoba.edu.co');
    $mail->Subject = 'Notificación - Olimpiadas de Matemáticas';
    $html = "<style>p{font-family: tahoma;}</style>
    <img src='https://www.unicordoba.edu.co/wp-content/uploads/2018/11/unicordoba_logo1.png'>
    <p>Estimado(a) docente</p>
    <p>".$nom." - ".$pmail."</p>
    <p>".$ie."</p>
    <br>
    <p>Cordial saludo:</p>
    <br>
    <p>Le informamos que se ha creado su cuenta como Coordinador de IE en la plataforma de inscripción pata las Olimpiadas de Matemáticas de la Universidad de Córdoba. A continuación, se detallan los pasos a seguir para acceder y comenzar a utilizar su cuenta:</p>
    <p>1. Debe esperar a que el administrador habilite su cuenta y le asigne una contraseña de ingreso, posteriormente, recibirá; un correo electrónico con los datos de acceso para su cuenta activa.</p>
    <p>2. Una vez que tenga su contraseña, podrá; acceder al sistema de Olimpiadas de Matemáticas con su usuario (correo) y contraseña.</p>
    <p>Si tiene alguna pregunta o inquietud, no dude en informar al correo: <b style='color:navy'><a href='mailto:cbanquet@correo.unicordoba.edu.co'>cbanquet@correo.unicordoba.edu.co</a></b> .Estamos a su disposición para ayudarle en lo que necesite.</p>
    <br>
    <p>Atentamente,</p>
    <br>
    <p>Administrador Olimpiadas de Matemáticas</p>
    <p><b>Universidad de Córdoba</b></p><hr>
    <small>Desarrollado por:</small>
    <img src='https://cintia.unicordoba.edu.co/wp-content/uploads/2023/03/CINTIA-LOGO.png' width='50%' height='50%'>";
    $mail->Body = $html;
    $mail->CharSet = 'utf-8';
    $mail->IsHTML(true);
    $mail->IsSMTP();
    $mail->Host = 'smtp.mi.com.co'; // Servidor de Salida
    $mail->Port = 465; //Puerto de salida
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Username = "admin@olimpiadasmatunicordoba.com.co"; // Tu cuenta de correo, debe ser una cuenta existente
    $mail->Password = "Unicor@2024"; // Tu contraseña
    //enviar
    $mail->Send();
}

function recovery_cta($nom, $pass, $pmail){
    $mail = new PHPMailer(); // Passing `true` enables exceptions
    $mail->From = 'admin@olimpiadasmatunicordoba.com.co'; // Dirección de correo remitente
    $mail->FromName = 'Olimpiadas de Matemáticas'; // Nombre del remitente
    //principal
    $mail->AddAddress(trim($pmail)); // Dirección del destinatario y nombre
    $mail->AddReplyTo('cbanquet@correo.unicordoba.edu.co');
    $mail->Subject = 'Recuperación Contraseña - Olimpiadas de Matemáticas';
    $html = "<style>p{font-family: tahoma;}</style>
    <img src='https://www.unicordoba.edu.co/wp-content/uploads/2018/11/unicordoba_logo1.png'>
    <p>Estimado(a) docente</p>
    <p>".$nom." - ".$pmail."</p>
    <br>
    <p>Cordial saludo:</p>
    <br>
    <p>Te informamos que tus credenciales de acceso son los siguientes:</p>
    <p>Usuario: <b>".$pmail."</b></p>
    <p>Contraseña: <b>".$pass."</b></p>
    <p>Te recomendamos cambiar tu contraseña en cuanto inicies sesión por seguridad. Para acceder a tu cuenta, por favor ingresa en el siguiente enlace:</p>
    <p><a href='https://olimpiadasmatunicordoba.com.co/' target='_blank'>Olimpiadas de Matemáticas - Universidad de Córdoba</p>
    <p>Si tiene alguna pregunta o inquietud, no dude en informar al correo: <b style='color:navy'><a href='mailto:cbanquet@correo.unicordoba.edu.co'>cbanquet@correo.unicordoba.edu.co</a></b> .Estamos a su disposición para ayudarle en lo que necesite.</p>
    <br>
    <p>Atentamente,</p>
    <br>
    <p>Administrador Olimpiadas de Matemáticas</p>
    <p><b>Universidad de Córdoba</b></p><hr>
    <small>Desarrollado por:</small>
    <img src='https://cintia.unicordoba.edu.co/wp-content/uploads/2023/03/CINTIA-LOGO.png' width='50%' height='50%'>";
    $mail->Body = $html;
    $mail->CharSet = 'utf-8';
    $mail->IsHTML(true);
    $mail->IsSMTP();
    $mail->Host = 'smtp.mi.com.co'; // Servidor de Salida
    $mail->Port = 465; //Puerto de salida
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Username = "admin@olimpiadasmatunicordoba.com.co"; // Tu cuenta de correo, debe ser una cuenta existente
    $mail->Password = "Unicor@2024"; // Tu contraseña
    //enviar
    $mail->Send();
}

function habilitar_cta($nom, $pass, $pmail, $cant, $lugar){
    $mail = new PHPMailer(); // Passing `true` enables exceptions
    $mail->From = 'admin@olimpiadasmatunicordoba.com.co'; // Dirección de correo remitente
    $mail->FromName = 'Olimpiadas de Matemáticas'; // Nombre del remitente
    //principal
    $mail->AddAddress(trim($pmail)); // Dirección del destinatario y nombre
    $mail->AddReplyTo('cbanquet@correo.unicordoba.edu.co');
    $mail->Subject = 'Cuenta Habilitada - Olimpiadas de Matemáticas';
    $html = "<style>p{font-family: tahoma;}</style>
    <img src='https://www.unicordoba.edu.co/wp-content/uploads/2018/11/unicordoba_logo1.png'>
    <p>Estimado(a) docente</p>
    <p>".$nom." - ".$pmail."</p>
    <br>
    <p>Cordial saludo:</p>
    <br>
    <p>Te informamos que tu cuenta ha sido <b>habilitada</b>, tus credenciales de acceso son los siguientes:</p>
    <p>Usuario: <b>".$pmail."</b></p>
    <p>Contraseña: <b>".$pass."</b></p>
    <p>Se asignó un cupo de inscripción para tu institución educativa de <b>".$cant."</b> estudiantes .</p>
    <p>Modalidad / Ubicación de la fase 1: <b>".$lugar."</b></p>
    <p>Te recomendamos cambiar tu contraseña en cuanto inicies sesión por seguridad. Para acceder a tu cuenta, por favor ingresa en el siguiente enlace:</p>
    <p><a href='https://olimpiadasmatunicordoba.com.co/' target='_blank'>Olimpiadas de Matemáticas - Universidad de Córdoba</p>
    <p>Si tiene alguna pregunta o inquietud, no dude en informar al correo: <b style='color:navy'><a href='mailto:cbanquet@correo.unicordoba.edu.co'>cbanquet@correo.unicordoba.edu.co</a></b> .Estamos a su disposición para ayudarle en lo que necesite.</p>
    <br>
    <p>Atentamente,</p>
    <br>
    <p>Administrador Olimpiadas de Matemáticas</p>
    <p><b>Universidad de Córdoba</b></p><hr>
    <small>Desarrollado por:</small>
    <img src='https://cintia.unicordoba.edu.co/wp-content/uploads/2023/03/CINTIA-LOGO.png' width='50%' height='50%'>";
    $mail->Body = $html;
    $mail->CharSet = 'utf-8';
    $mail->IsHTML(true);
    $mail->IsSMTP();
    $mail->Host = 'smtp.mi.com.co'; // Servidor de Salida
    $mail->Port = 465; //Puerto de salida
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Username = "admin@olimpiadasmatunicordoba.com.co"; // Tu cuenta de correo, debe ser una cuenta existente
    $mail->Password = "Unicor@2024"; // Tu contraseña
    //enviar
    $mail->Send();
}
?>