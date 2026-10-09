<?php
require dirname(__DIR__, 2) . '/modules/shared/conexion.php';
mysqli_set_charset($con, "utf8");
$mpio = $_REQUEST['mpio'] ?? '';
$stmt = $con->prepare("SELECT idIES, nombre FROM ies WHERE mpio = ? ORDER BY nombre ASC");
$stmt->bind_param('s', $mpio);
$stmt->execute();
$res = $stmt->get_result();
$datos = array();
while ($lista = $res->fetch_assoc()) {
    $datos[] = array('id'=> $lista['idIES'], 'nombre'=> $lista['nombre']);
}
echo json_encode($datos);

$con->close();
?>