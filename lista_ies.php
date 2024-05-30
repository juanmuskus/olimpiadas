<?php
include 'conexion.php';
$mpio = utf8_decode($_GET['mpio']);
$sql = "SELECT * FROM ies where (mpio = '$mpio') ORDER BY nombre ASC";
$res = $con->query($sql);
$datos = array();
while ($lista = $res->fetch_assoc()) {
    $datos[] = array('id'=> $lista['idIES'], 'nombre'=> utf8_encode($lista['nombre']));
} 

$json = json_encode($datos, JSON_PRETTY_PRINT);
echo $json;

$con->close();
?>