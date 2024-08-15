<?php 
 $key_api = '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';
# ------------------

require_once('vendor/autoload.php');

// Configure API key authorization: api-key
$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $key_api);

// Uncomment below line to configure authorization using: partner-key
// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');

$apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
$sendSmtpEmail['to'] = array(array('email'=>'juanmuskus@hotmail.com', 'name'=>'Olimpiadas Maths'));
$sendSmtpEmail['subject'] = 'Olimpiadas de Matemáticas - Universidad de Córdoba';
$sendSmtpEmail['templateId'] = 1;
$sendSmtpEmail['params'] = array('nom'=>'J Muskus Muskus', 'mail'=>'temp@gmail.com', 'ies'=>'liceo Sahagun - Sahagun');
$sendSmtpEmail['headers'] = array('X-Mailin-custom'=>'custom_header_1:custom_value_1|custom_header_2:custom_value_2');

try {
    $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
} catch (Exception $e) {
    echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
}
?>