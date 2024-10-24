<?php
include("conexion.php");
$doci = $_GET['doci'];
// buscar los datos del estudiante
$sql = "SELECT CONCAT(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) AS noms, grado, CONCAT(i.nombre,' de ',mpio) AS col  FROM estudiantes e, ies i WHERE (i.idIES = e.IES_idIES) AND (doc = $doci)"; 
$res = $con->query($sql);
$datos = $res->fetch_assoc();
if ($res->num_rows < 1){
    echo "<p class='text-primary'>No se encontró el estudiante asociado a este doc. de identidad </p>";
    exit();
}
else {
    $noms = $datos['noms'];
    $grado = $datos['grado'];
    $col = $datos['col'];
echo "<table class='table'>
            <tr>
                <th>Nombres</th>
                <th>IE</th>
                <th>Grado</th>
                <th>Certificado</th>
            </tr>
            <tr>
                <td>" . iconv("ISO-8859-1", "UTF-8//IGNORE",$noms) . "</td>
                <td>" . iconv("ISO-8859-1", "UTF-8//IGNORE",$col) . "</td>
                <td>" . $grado . "</td>
                <td><a href='certificado_PDF.php?nom=".$noms."&ie=".$col."&grado=".$grado."' target='_blank'><buttto class='btn btn-success'><i class='bi bi-arrow-bar-down'></i> Descargar</buttto></a></td>
            </tr>
        </table>";
}
$con->close();
//12114545
?>