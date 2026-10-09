<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$databaseConfig = [];
foreach (['HOST', 'USER', 'PASS', 'DB'] as $key) {
    $value = $_ENV[$key] ?? null;
    if (!is_string($value) || ($key !== 'PASS' && $value === '')) {
        throw new RuntimeException("Missing required database configuration: {$key}");
    }
    $databaseConfig[] = $value;
}

[$host, $user, $pass, $db] = $databaseConfig;
$con = new mysqli($host, $user, $pass, $db);
$con->set_charset('utf8mb4');
?>