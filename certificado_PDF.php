
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php

        $nom = $_REQUEST['nom'];
        $ie = $_REQUEST['ie'];
        
        require('fpdf/fpdf.php');
        header("Content-Type: text/html;charset=utf-8");

        $pdf = new FPDF('L','mm','Letter');
        $pdf-> AddPage();
        $pdf-> SetFont('Times','B','30');
        $ruta = "img/certificado.jpg";;

        if ($ruta[0] === '/')
        $res = substr($ruta, 1); 
        
        $pdf-> Image($ruta,'3','3','272','211','','');
        $pdf->ln(68);
        $pdf-> Cell('257','8',iconv('UTF-8', 'windows-1252',$nom),'0','','C');
        $pdf-> ln(9);
        $pdf-> SetFont('Times','','18');

        $pdf-> Cell('257','8','I.E. '.iconv('UTF-8', 'windows-1252',$ie),'0','','C');
        $pdf-> ln(17);
        $pdf-> SetFont('Times','','7');
        $pdf-> Cell('150','8','','0');
        $pdf-> ln(15);
        
        ob_end_clean();
        $pdf->Output('I');
?>
</body>
</html>