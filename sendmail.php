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
function notificar_cta($nom, $ie, $mail){
    $key_api = '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';
    # ------------------
    require_once('vendor/autoload.php');

    // Configure API key authorization: api-key
    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $key_api);

    // Uncomment below line to configure authorization using: partner-key
    // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');

    $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
        new GuzzleHttp\Client(         
        ),
        $config
    );
    $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
    $sendSmtpEmail['subject'] = 'Olimpiadas de Matemáticas - Universidad de Córdoba';
    $sendSmtpEmail['to'] = array(array('email' => $mail, 'name' => $nom));
    $sendSmtpEmail['templateId'] = 1;
    $sendSmtpEmail['params'] = array('nom' => $nom, 'mail' => $mail, 'ies' => $ie);

    $sendSmtpEmail['headers'] = array('X-Mailin-custom' => 'custom_header_1:custom_value_1|custom_header_2:custom_value_2');

    try {
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    } catch (Exception $e) {
        echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
    }
}

function recovery_cta($nom, $pass, $mail){
    $key_api = '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';
    # ------------------
    require_once('vendor/autoload.php');

    // Configure API key authorization: api-key
    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $key_api);

    // Uncomment below line to configure authorization using: partner-key
    // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');

    $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
        new GuzzleHttp\Client(         
        ),
        $config
    );
    $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
    $sendSmtpEmail['subject'] = 'Recuperación contraseña - Olimpiadas de Matemáticas';
    $sendSmtpEmail['to'] = array(array('email' => $mail, 'name' => $nom));
    $sendSmtpEmail['templateId'] = 4;
    $sendSmtpEmail['params'] = array('nom' => $nom, 'email' => $mail, 'pass' => $pass, 'link'=>'http://localhost/olimpiadas/index.php');

    $sendSmtpEmail['headers'] = array('X-Mailin-custom' => 'custom_header_1:custom_value_1|custom_header_2:custom_value_2');

    try {
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    } catch (Exception $e) {
        echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
    }
}

?>
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