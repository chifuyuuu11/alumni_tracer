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
        $this->SetFont('Arial', 'B', 17);
        // FillColorFont //
        $this->SetTextColor(255, 0, 0);
        // Title
        $this->Cell(0, 10, 'Saint Francis of Assisi College', 0, 1, 'C');
        // FillColorFont - Address //
        $this->SetTextColor(0);
        // Address //
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 2, utf8_decode('Bacoor - Las Piñas'), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 18);

        $this->Cell(0, 5, '', 0, 1, 'C');
        $this->Cell(0, 10, "Alumni List", 0, 1, 'C');
        $this->Cell(0, 5, '', 0, 1, 'C');

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

if ($_GET['category'] == "All") {
    $select_alumni = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
    LEFT JOIN tbl_alumni ON tbl_alumni.user_id = tbl_users.user_id
    LEFT JOIN tbl_attained ON tbl_attained.attained_id = tbl_alumni.attained_id
    LEFT JOIN tbl_programs ON tbl_programs.program_id = tbl_alumni.program_id
    LEFT JOIN tbl_employment_status ON tbl_employment_status.estatus_id = tbl_alumni.estatus_id
    LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
    WHERE role_id = 1
    AND 
        CASE WHEN '$_GET[attained]' = 'ALL'
        THEN
            1 = 1
        ELSE
            attained IN ('$_GET[attained]')
        END
    AND
        CASE WHEN '$_GET[estatus]' <> 'ALL'
        THEN
            employment_status IN ('$_GET[estatus]')
        ELSE
            1 = 1
        END
    AND
        CASE WHEN '$_GET[program]' = 'ALL'
        THEN
            1 = 1
        ELSE
            program_desc IN ('$_GET[program]')
        END
    AND
        CASE WHEN '$_GET[campus]' = 'ALL'
        THEN
            1 = 1
        ELSE
            campus IN ('$_GET[campus]')
        END
    AND
        CASE WHEN '$_GET[alligned]' = 'ALL'
        THEN
            1 = 1
        ELSE
            alligned IN ('$_GET[alligned]')
        END
    AND
        CASE WHEN '$_GET[batch]' = 'ALL'
        THEN
            1 = 1
        ELSE
            batch IN ('$_GET[batch]')
        END
    ORDER BY lastname");

} elseif ($_GET['category'] == "campus") {
    $category = $_GET['category'];
    $sort = $_GET['sort'];

    $select_alumni = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
    LEFT JOIN tbl_alumni ON tbl_alumni.user_id = tbl_users.user_id
    LEFT JOIN tbl_attained ON tbl_attained.attained_id = tbl_alumni.attained_id
    LEFT JOIN tbl_programs ON tbl_programs.program_id = tbl_alumni.program_id
    LEFT JOIN tbl_employment_status ON tbl_employment_status.estatus_id = tbl_alumni.estatus_id
    LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
    WHERE role_id = 1
    AND 
        CASE WHEN '$_GET[attained]' = 'ALL'
        THEN
            1 = 1
        ELSE
            attained IN ('$_GET[attained]')
        END
    AND
        CASE WHEN '$_GET[estatus]' <> 'ALL'
        THEN
            employment_status IN ('$_GET[estatus]')
        ELSE
            1 = 1
        END
    AND
        CASE WHEN '$_GET[program]' = 'ALL'
        THEN
            1 = 1
        ELSE
            program_desc IN ('$_GET[program]')
        END
    AND
        CASE WHEN '$_GET[campus]' = 'ALL'
        THEN
            1 = 1
        ELSE
            campus IN ('$_GET[campus]')
        END
    AND
        CASE WHEN '$_GET[alligned]' = 'ALL'
        THEN
            1 = 1
        ELSE
            alligned IN ('$_GET[alligned]')
        END
    AND
        CASE WHEN '$_GET[batch]' = 'ALL'
        THEN
            1 = 1
        ELSE
            batch IN ('$_GET[batch]')
        END
    ORDER BY $category $sort, lastname");

} else {
    $category = $_GET['category'];
    $sort = $_GET['sort'];

    $select_alumni = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
    LEFT JOIN tbl_alumni ON tbl_alumni.user_id = tbl_users.user_id
    LEFT JOIN tbl_attained ON tbl_attained.attained_id = tbl_alumni.attained_id
    LEFT JOIN tbl_programs ON tbl_programs.program_id = tbl_alumni.program_id
    LEFT JOIN tbl_employment_status ON tbl_employment_status.estatus_id = tbl_alumni.estatus_id
    LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
    WHERE role_id = 1
    AND 
        CASE WHEN '$_GET[attained]' = 'ALL'
        THEN
            1 = 1
        ELSE
            attained IN ('$_GET[attained]')
        END
    AND
        CASE WHEN '$_GET[estatus]' <> 'ALL'
        THEN
            employment_status IN ('$_GET[estatus]')
        ELSE
            1 = 1
        END
    AND
        CASE WHEN '$_GET[program]' = 'ALL'
        THEN
            1 = 1
        ELSE
            program_desc IN ('$_GET[program]')
        END
    AND
        CASE WHEN '$_GET[campus]' = 'ALL'
        THEN
            1 = 1
        ELSE
            campus IN ('$_GET[campus]')
        END
    AND
        CASE WHEN '$_GET[alligned]' = 'ALL'
        THEN
            1 = 1
        ELSE
            alligned IN ('$_GET[alligned]')
        END
    AND
        CASE WHEN '$_GET[batch]' = 'ALL'
        THEN
            1 = 1
        ELSE
            batch IN ('$_GET[batch]')
        END
    ORDER BY tbl_alumni.$category $sort, lastname");
}

// Instanciation of inherited class
$pdf = new PDF('L', 'mm', 'Legal');
$pdf->SetMargins(10, 8, 10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(75, 5, 'Name', 'B, T, L, R', 0);
$pdf->Cell(65, 5, 'Email', 'B, T, L R', 0);
$pdf->Cell(30, 5, 'Contact', 'B, T, L R', 0);

$pdf->Cell(30, 5, 'Campus', 'B, T, L R', 0);
$pdf->Cell(35, 5, 'Highest Attained', 'B, T, L R', 0);


$pdf->Cell(35, 5, 'Status', 'B, T, L R', 0);
$pdf->Cell(35, 5, 'Current Work', 'B, T, L R', 0);
$pdf->Cell(35, 5, 'Alligned', 'B, T, L R', 1);

$x = 1;

while ($row = mysqli_fetch_array($select_alumni)) {

    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellWidth = 5;
    while ($pdf->GetStringWidth($x) > $cellWidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(6, 7, $x . '.', 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $fontsize = 11;
    $tempFontSize = $fontsize;
    $cellWidth = 67;
    $fullname = ucwords(strtolower(utf8_decode($row['fullname'])));

    while ($pdf->GetStringWidth($fullname) > $cellWidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(69, 7, $fullname, 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 63;
    $email = utf8_decode($row['email']);

    while ($pdf->GetStringWidth($email) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(65, 7, $email, 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(30, 7, $row['contact'], 0, 0);


    $pdf->SetFont('Arial', '', 11);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 28;
    $campus = utf8_decode($row['campus']);

    while ($pdf->GetStringWidth($campus) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(30, 7, $campus, 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 33;
    $attained = utf8_decode($row['attained']);

    while ($pdf->GetStringWidth($attained) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(35, 7, $row['attained'], 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(35, 7, $row['employment_status'], 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $fontsize = 9;
    $tempFontSize = $fontsize;
    $cellwidth = 33;
    $current_work = utf8_decode($row['current_work']);

    while ($pdf->GetStringWidth($current_work) > $cellwidth) {
        $pdf->SetFontSize($tempFontSize -= 0.1);
    }
    $pdf->Cell(35, 7, utf8_decode($row['current_work']), 0, 0);

    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(35, 7, $row['alligned'], 0, 1);


    $pdf->SetFont('Arial', '', 11);
    $x++;
}

$pdf->Output();

?>