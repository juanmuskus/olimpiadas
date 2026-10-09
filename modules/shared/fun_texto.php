<?php
function num2Text($nro)
{
    $entero = floor($nro);
    $decimales = round(($nro - $entero) * 100);
    $res = __num2text($entero);
    if ($decimales > 0) {
        $res .= " CON " . __num2text($decimales);
    }
    return $res;
}

function __num2text($value)
{
    $value = intval($value);
    $units = [
        0 => "CERO", 1 => "UNO", 2 => "DOS", 3 => "TRES", 4 => "CUATRO", 5 => "CINCO",
        6 => "SEIS", 7 => "SIETE", 8 => "OCHO", 9 => "NUEVE", 10 => "DIEZ",
        11 => "ONCE", 12 => "DOCE", 13 => "TRECE", 14 => "CATORCE", 15 => "QUINCE"
    ];
    if ($value <= 15) return $units[$value];
    if ($value < 20) return "DIECI" . __num2text($value - 10);
    if ($value == 20) return "VEINTE";
    if ($value < 30) return "VEINTI" . __num2text($value - 20);
    $tens = [
        30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA",
        70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA"
    ];
    if ($value < 100) {
        $ten = floor($value / 10) * 10;
        $unit = $value % 10;
        return $tens[$ten] . ($unit ? " Y " . __num2text($unit) : "");
    }
    if ($value == 100) return "CIEN";
    if ($value < 200) return "CIENTO " . __num2text($value - 100);
    $hundreds = [
        200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS",
        500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS",
        800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    ];
    if (isset($hundreds[$value])) return $hundreds[$value];
    if ($value < 1000) {
        $hundred = floor($value / 100) * 100;
        return __num2text($hundred) . " " . __num2text($value % 100);
    }
    if ($value == 1000) return "MIL";
    if ($value < 2000) return "MIL " . __num2text($value % 1000);
    if ($value < 1000000) {
        $mil = floor($value / 1000);
        $rest = $value % 1000;
        $txt = __num2text($mil) . " MIL";
        if ($rest > 0) $txt .= " " . __num2text($rest);
        return $txt;
    }
    if ($value == 1000000) return "UN MILLON";
    if ($value < 2000000) return "UN MILLON " . __num2text($value % 1000000);
    if ($value < 1000000000000) {
        $millones = floor($value / 1000000);
        $rest = $value % 1000000;
        $txt = __num2text($millones) . " MILLONES";
        if ($rest > 0) $txt .= " " . __num2text($rest);
        return $txt;
    }
    if ($value == 1000000000000) return "UN BILLON";
    if ($value < 2000000000000) return "UN BILLON " . __num2text($value % 1000000000000);
    $billones = floor($value / 1000000000000);
    $rest = $value % 1000000000000;
    $txt = __num2text($billones) . " BILLONES";
    if ($rest > 0) $txt .= " " . __num2text($rest);
    return $txt;
}
?>
