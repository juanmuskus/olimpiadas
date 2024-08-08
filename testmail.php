<?php
// Dirección de correo del destinatario
$to = 'grupometrico@gmail.com';

// Asunto del correo
$subject = 'Asunto';

// Mensaje del correo
$message = 'Este es el cuerpo del mensaje del correo.';

// Cabeceras del correo
$headers = 'From: jmuskus@correo.unicordoba.edu.co' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Enviar el correo
if (mail($to, $subject, $message, $headers)) {
    echo 'Correo enviado exitosamente.';
} else {
    echo 'Error al enviar el correo.';
}
?>