<?php

function renderParticipationCertificate(int $round): void
{
    $studentName = $_GET['nom'] ?? null;
    $institution = $_GET['ie'] ?? null;
    $gradeInput = $_GET['grado'] ?? null;
    $grade = is_scalar($gradeInput) ? filter_var($gradeInput, FILTER_VALIDATE_INT) : false;
    $gradeNames = [
        6 => 'Sexto',
        7 => 'Séptimo',
        8 => 'Octavo',
        9 => 'Noveno',
        10 => 'Décimo',
        11 => 'Once',
    ];

    if (
        !is_string($studentName) || trim($studentName) === ''
        || !is_string($institution) || trim($institution) === ''
        || $grade === false || !isset($gradeNames[$grade])
        || !in_array($round, [1, 2], true)
    ) {
        http_response_code(400);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Faltan datos válidos para generar el certificado.';
        return;
    }

    require_once dirname(__DIR__, 2) . '/fpdf/fpdf.php';

    $toPdfText = static function (string $text): string {
        $converted = iconv('UTF-8', 'windows-1252//TRANSLIT', $text);
        if ($converted === false) {
            throw new RuntimeException('No se pudo convertir el texto del certificado.');
        }

        return $converted;
    };

    $pdf = new FPDF('L', 'mm', 'Letter');
    $pdf->SetMargins(18, 18, 18);
    $pdf->SetAutoPageBreak(false);
    $pdf->AddPage();

    $pdf->SetDrawColor(42, 83, 117);
    $pdf->SetLineWidth(1.2);
    $pdf->Rect(10, 10, 259, 197);
    $pdf->SetLineWidth(0.35);
    $pdf->Rect(13, 13, 253, 191);

    $pdf->SetTextColor(42, 83, 117);
    $pdf->SetFont('Times', 'B', 25);
    $pdf->SetY(34);
    $pdf->Cell(0, 14, $toPdfText('CERTIFICADO DE PARTICIPACIÓN'), 0, 1, 'C');
    $pdf->SetDrawColor(120, 155, 177);
    $pdf->Line(48, 54, 231, 54);

    $pdf->SetTextColor(70, 70, 70);
    $pdf->SetFont('Times', '', 16);
    $pdf->SetY(68);
    $pdf->Cell(0, 10, $toPdfText('Se otorga el presente certificado a:'), 0, 1, 'C');

    $pdf->SetTextColor(25, 48, 69);
    $pdf->SetFont('Times', 'B', 29);
    $pdf->SetY(86);
    $pdf->MultiCell(0, 13, $toPdfText(mb_strtoupper(trim($studentName), 'UTF-8')), 0, 'C');

    $roundName = $round === 1 ? 'Primera ronda' : 'Segunda ronda';
    $description = "por su participación en {$roundName} de las Olimpiadas de Matemáticas";
    $pdf->SetTextColor(70, 70, 70);
    $pdf->SetFont('Times', '', 16);
    $pdf->SetY(119);
    $pdf->MultiCell(0, 9, $toPdfText($description), 0, 'C');

    $pdf->SetTextColor(42, 83, 117);
    $pdf->SetFont('Times', 'B', 18);
    $pdf->SetY(145);
    $pdf->Cell(0, 10, $toPdfText('Grado ' . $gradeNames[$grade]), 0, 1, 'C');

    $pdf->SetTextColor(70, 70, 70);
    $pdf->SetFont('Times', '', 14);
    $pdf->SetY(162);
    $pdf->MultiCell(0, 8, $toPdfText('Institución educativa: ' . trim($institution)), 0, 'C');

    $pdf->Output('I');
}
