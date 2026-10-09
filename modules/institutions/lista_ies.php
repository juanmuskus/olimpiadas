<?php
include 'conexion.php';
mysqli_set_charset($con, "utf8");
$mpio = $_REQUEST['mpio'];
$sql = "SELECT * FROM ies where (mpio = '$mpio') ORDER BY nombre ASC";
$res = $con->query($sql);
$datos = array();
while ($lista = $res->fetch_assoc()) {
    $datos[] = array('id'=> $lista['idIES'], 'nombre'=> $lista['nombre']);
} 
$json = json_encode($datos);
echo $json;

$con->close();
?>