<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['HOST'];
$user = $_ENV['USER'];
$pass = $_ENV['PASS'];
$db = $_ENV['DB'];//
$con = new mysqli($host, $user, $pass, $db);
?>