<?php
require '../../includes/conn.php';
require '../fpdf/fpdf.php';
error_reporting(E_ALL ^ E_DEPRECATED);

// $pdf = new FPDF('P', 'mm', 'Legal');
// $pdf->SetMargins(10,10,10);
// $pdf->AddPage();
// $pdf->SetFont('Arial','B',16);
// $pdf->Image('../../docs/assets/img/SFAC-Logo.jpg', 27,3,19,19);


// $pdf->Cell(40,10,'Hello World!');
// $pdf->Output();
//
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../../docs/assets/img/SFAC-Logo.jpg', 56, 10, 15);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 14);
        // FillColorFont //
        $this->SetTextColor(255, 0, 0);
        // Title
        $this->Cell(200, 10, 'Saint Francis of Assisi College', 0, 1, 'C');
        // FillColorFont - Address //
        $this->SetTextColor(0);
        // Address //
        $this->SetFont('Arial', '', 10);
        $this->Cell(196.5, 2, '96 Bayanan, City of Bacoor, Cavite', 0, 1, 'C');
        // Alumni //
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(190, 18, 'STUDENT LIST', 0, 1, 'C');

        $this->SetFont('Arial', '', 12);
        $this->Cell(75, 7, 'Name', 'B, T, L, R', 0);
        $this->Cell(75, 7, 'Email', 'B, T, L R', 0);
        $this->Cell(40, 7, 'Contact', 'B, T, L R', 1);

        // // Line break
        // $this->Ln(25);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF('P', 'mm', 'Legal');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 11);
// $pdf->Cell(75, 7, 'Name', 'B, T, L, R', 0);
// $pdf->Cell(75, 7, 'Email', 'B, T, L R', 0);
// $pdf->Cell(40, 7, 'Contact', 'B, T, L R', 1);

$x = 1;
$select_alumni = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users WHERE role_id = 2 ORDER BY lastname");
while ($row = mysqli_fetch_array($select_alumni)) {
    $pdf->Cell(6, 7, $x. '.', 0, 0);

    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellWidth = 69;
    $fullname = utf8_decode($row['fullname']);

    while ($pdf->GetStringWidth($fullname) > $cellWidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(69, 7, $row['fullname'], 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 75;
    $email = utf8_decode($row['email']);

    while ($pdf->GetStringWidth($email) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(75, 7, $row['email'], 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(75, 7, $row['contact'], 0, 1);

    $x++;
}

$pdf->Output();

?>