<?php session_start();
if (isset($_SESSION['usuario'])) {
    $us = $_SESSION['usuario'];
    $tipo = $_SESSION['tipo'];
    $mail = $_SESSION['mail'];
    $id_ies=$_SESSION['id_ies'];
    $cant_est=$_SESSION['cant_est'];
} else {
    echo "<title>Error</title>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css'>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>";
    echo "<div style='margin: 20px 20px 20px 20px;'><div class='alert alert-danger' role='alert'>";
    echo "Ud no posee acceso al sistema !!!";
    echo "<hr><a href='index.php'><button class='btn btn-danger'><i class='bi bi-box-arrow-in-left'> </i>Login</button></a></div></div>";
    die();
}
?>
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
		include('conexion.php');
		// Definimos el archivo exportado
		$arquivo = 'listado.xls';

		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="0">';

		$html .= '<tr>';
		$html .= '<td>username</td>';
		$html .= '<td>firstname</td>';
		$html .= '<td>lastname</td>';
		$html .= '<td>email</td>';
		$html .= '<td>password</td>';
		$html .= '<td>country</td>';
		$html .= '<td>profile_field_programa</td>';
		$html .= '<td>course1</td>';
		$html .= '<td>type1</td>';
		$html .= '<td>group1</td>';
		$html .= '</tr>';

		//Seleccionar todos los elementos de la tabla
        $pass = 'Unicor@'.date('y');
		$sql = "SELECT doc AS username, CONCAT(nombre1,' ',nombre2) AS firstname, CONCAT(apellido1,' ',apellido2) AS lastname, email, '$pass' AS password, 'CO' AS country, i.nombre, i.mpio, 
            case grado 
            when 6 then 'M061'
            when 7 then 'M071'
            when 8 then 'M081'
            when 9 then 'M091'
            when 10 then 'M010'
            when 11 then 'M011'
            end
            AS course1,
            1 AS type1, nombre AS group1
            FROM estudiantes e, ies i
            WHERE idIES = IES_idIES";
        
        $datos = mysqli_query($con, $sql);

		while ($rows = mysqli_fetch_assoc($datos)) {
			$html .= '<tr>';
			$html .= '<td>' . $rows["username"] . '</td>';
			$html .= '<td>' . $rows["firstname"] . '</td>';
			$html .= '<td>' . $rows["lastname"] . '</td>';
			$html .= '<td>' . $rows["email"] . '</td>';
			$html .= '<td>' . $rows["password"] . '</td>';
			$html .= '<td>' . $rows["country"] . '</td>';
			$html .= '<td>' . $rows['nombre'].' '. $rows['mpio'] .'</td>';
			$html .= '<td>' . $rows["course1"] . '</td>';
			$html .= '<td>' . $rows["type1"] . '</td>';
			$html .= '<td>' . $rows['group1'] . '</td>';
			$html .= '</tr>';;
		}
		// Configuración en la cabecera
		header("Expires: Mon, 26 Jul 2227 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-type: application/x-msexcel");
		header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		header("Content-Description: PHP Generado CINTIA");
		// Envia contenido al archivo
		echo $html;
        $con->close();
		exit; ?>
</body>
</html>