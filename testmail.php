<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Si usas Composer, asegúrate de que el autoloader esté incluido

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.mail.yahoo.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'juanmuskus@yahoo.com';
    $mail->Password   = 'jrkquldloxmjjydv';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Remitente y destinatario
    $mail->setFrom('juanmuskus@yahoo.com', 'Juan Muskus');
    $mail->addAddress('grupometrico@gmail.com', 'Destinatario');

    // Contenido del correo
    $mail->isHTML(true);                                        // Establece el formato del correo en HTML
    $mail->Subject = 'Aquí está el asunto';
    $mail->Body    = 'Este es el contenido del correo en <b>HTML</b>';
    $mail->AltBody = 'Este es el contenido del correo en texto plano';

    $mail->send();
    echo 'El correo ha sido enviado.';
} catch (Exception $e) {
    echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
}
?>
