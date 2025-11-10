
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
        $rgrado = $_REQUEST['grado'];
        switch ($rgrado) {
            case 6:
                $grado = "Sexto";
                break;
            case 7:
                $grado = "Septimo";
                break;
            case 8:
                $grado = "Octavo";
                break;
            case 9:
                $grado = "Noveno";
                break;
            case 10:
                $grado = "Decimo";
                break;
            case 11:
                $grado = "Once";
                break;
            default:
                $grado = "No definido";
                break;
        }
        
        require('fpdf/fpdf.php');
        //header("Content-Type: text/html;charset=utf-8");

        $pdf = new FPDF('L','mm','Letter');
        $pdf-> AddPage();
        $pdf-> SetFont('Times','B','30');
        $ruta = "img/certificado.jpg";;

        if ($ruta[0] === '/')
        $res = substr($ruta, 1); 
        
        $pdf-> Image($ruta,'3','3','272','211','','');
        $pdf->ln(65);
        $pdf-> Cell('257','8',iconv('UTF-8', 'windows-1252',$nom),'0','','C');
        $pdf-> ln(9);
        $pdf->SetTextColor(0,0,0); 
        $pdf-> SetFont('Times','','18');

        $pdf-> Cell('257','8','I.E. '.iconv('UTF-8', 'windows-1252',$ie),'0','','C');
        $pdf-> ln(17);
        $pdf-> SetFont('Times','','7');
        $pdf-> Cell('150','8','','0');
        $pdf-> ln(15);
        
        $pdf->SetXY(1, 114);
        $pdf-> SetFont('Times','','18');
        $pdf->SetTextColor(20, 90, 50);
        $pdf-> Cell('223','8',strtoupper($grado),'0','','C');

        ob_end_clean();
        $pdf->Output('I');
?>
</body>
</html>