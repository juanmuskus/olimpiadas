<?php 
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true); // Passing `true` enables exceptions
$mail->From = 'jmuskus@correo.unicordoba.edu.co'; // Dirección de correo remitente
$mail->FromName = 'Olimpiadas de Matemáticas'; // Nombre del remitente
$mail->AddReplyTo('cbanquet@correo.unicordoba.edu.co'); // Dirección de correo para respuestas
//principal
$mail->AddAddress('grupometrico@gmail.com'); // Dirección del destinatario y nombre
$mail->Subject = 'Tester de Correo';
$mail->Body = 'Este es un correo de prueba';
$mail->CharSet = 'utf-8';
$mail->IsHTML(true);
$mail->IsSMTP();
$mail->Host = 'smtp.mi.com.co'; // Servidor de Salida
$mail->Port = 465; //Puerto de salida
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Username = "admin@olimpiadasmatunicordoba.com.co"; // Tu cuenta de correo, debe ser una cuenta existente
$mail->Password = "Unicor@2024"; // Tu contraseña
//guid
$mail->Send();

?>