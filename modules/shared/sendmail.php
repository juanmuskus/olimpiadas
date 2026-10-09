<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function mailSetting(string $name): string
{
    $value = $_ENV[$name] ?? null;
    if (!is_string($value) || $value === '') {
        throw new RuntimeException("Missing required mail configuration: {$name}");
    }

    return $value;
}

function createOlympiadMailer(): PHPMailer
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = mailSetting('MAIL_HOST');
    $mail->Port = (int) mailSetting('MAIL_PORT');
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'] ?? PHPMailer::ENCRYPTION_SMTPS;
    $mail->Username = mailSetting('MAIL_USERNAME');
    $mail->Password = mailSetting('MAIL_PASSWORD');
    $mail->setFrom(mailSetting('MAIL_FROM_ADDRESS'), mailSetting('MAIL_FROM_NAME'));

    $replyTo = $_ENV['MAIL_REPLY_TO'] ?? '';
    if ($replyTo !== '') {
        $mail->addReplyTo($replyTo);
    }

    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->isHTML(true);

    return $mail;
}

function applicationUrl(): string
{
    return rtrim(mailSetting('APP_URL'), '/');
}

function notificar_cta($nom, $ie, $pmail): void
{
    $mail = createOlympiadMailer();
    $mail->addAddress(trim($pmail));
    $mail->Subject = 'Notificación - Olimpiadas de Matemáticas';
    $mail->Body = "<p>Hola {$nom},</p>
        <p>Se ha recibido tu solicitud para coordinar la participación de {$ie} en las Olimpiadas de Matemáticas.</p>
        <p>Recibirás otro mensaje cuando tu cuenta esté habilitada.</p>
        <p>Atentamente,<br>Administración de las Olimpiadas de Matemáticas</p>";
    $mail->send();
}

function recovery_cta($nom, $pass, $pmail): void
{
    $mail = createOlympiadMailer();
    $mail->addAddress(trim($pmail));
    $mail->Subject = 'Recuperación de contraseña - Olimpiadas de Matemáticas';
    $url = htmlspecialchars(applicationUrl(), ENT_QUOTES, 'UTF-8');
    $mail->Body = "<p>Hola {$nom},</p>
        <p>Usuario: <b>{$pmail}</b></p>
        <p>Contraseña: <b>{$pass}</b></p>
        <p>Te recomendamos cambiar la contraseña después de iniciar sesión.</p>
        <p><a href='{$url}'>Ingresar al sistema de Olimpiadas de Matemáticas</a></p>
        <p>Atentamente,<br>Administración de las Olimpiadas de Matemáticas</p>";
    $mail->send();
}

function habilitar_cta($nom, $pass, $pmail, $cant, $lugar): void
{
    $mail = createOlympiadMailer();
    $mail->addAddress(trim($pmail));
    $mail->Subject = 'Cuenta habilitada - Olimpiadas de Matemáticas';
    $url = htmlspecialchars(applicationUrl(), ENT_QUOTES, 'UTF-8');
    $mail->Body = "<p>Hola {$nom},</p>
        <p>Tu cuenta ha sido habilitada.</p>
        <p>Usuario: <b>{$pmail}</b></p>
        <p>Contraseña: <b>{$pass}</b></p>
        <p>Cupo de inscripción asignado: <b>{$cant}</b> estudiantes.</p>
        <p>Modalidad / ubicación de la primera etapa: <b>{$lugar}</b></p>
        <p>Te recomendamos cambiar la contraseña después de iniciar sesión.</p>
        <p><a href='{$url}'>Ingresar al sistema de Olimpiadas de Matemáticas</a></p>
        <p>Atentamente,<br>Administración de las Olimpiadas de Matemáticas</p>";
    $mail->send();
}
