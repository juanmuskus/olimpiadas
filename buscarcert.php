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
                <td>" . $noms . "</td>
                <td>" . $col . "</td>
                <td>" . $grado . "</td>
                <td><a href='certificado_PDF.php?nom=".$noms."&ie=".$col."&grado=".$grado."' target='_blank'><buttto class='btn btn-success'><i class='bi bi-patch-check'></i> 1<sup>ra</sup> Ronda</buttto></a></td>
            </tr>";
            buscar_ser2r($doci);
        echo "</table>";
}
$con->close();
//12114545

function buscar_ser2r($id){
    $file = fopen("DB/lista_2r.csv", "r");
    if ($file !== FALSE) {
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if ($data[0] == $id) {
                $nom = iconv("ISO-8859-1", "UTF-8//IGNORE", $data[1])." ".iconv("ISO-8859-1", "UTF-8//IGNORE", $data[2]);
                $col = iconv("ISO-8859-1", "UTF-8//IGNORE", $data[4]);
                $grado = iconv("ISO-8859-1", "UTF-8//IGNORE", $data[5]);
                echo "<tr>
                        <td>" . utf8_decode($nom)."</td>
                        <td>" . utf8_decode($col) . "</td>
                        <td>" . $grado . "</td>
                        <td><a href='certificado_PDF2.php?nom=".$nom."&ie=".$col."&grado=".$grado."' target='_blank'><buttto class='btn btn-warning'><i class='bi bi-patch-check'></i> 2<sup>da</sup> Ronda</buttto></a></td>
                    </tr>";
                break;
            }
        }
        fclose($file);
    }
}
?>