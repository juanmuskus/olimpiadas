<?php
$to = "grupometrico@gmail.com";
$subject = "Asunto del correo";
$message = "Este es un correo de prueba.";
$headers = "From: grupometrico@gmail.com";

// Envío del correo
if (mail($to, $subject, $message, $headers)) {
    echo "Correo enviado correctamente.";
} else {
    echo "Error al enviar el correo.";
}

?>