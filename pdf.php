<?php
require('fpdf/fpdf.php');

// Retrieve data from the query string
$telugu = $_GET['telugu'];
$hindi = $_GET['hindi'];
$english = $_GET['english'];
$maths = $_GET['maths'];
$science = $_GET['science'];
$social = $_GET['social'];
$id = $_GET['id'];
$classname = $_GET['class_name'];
$examType = $_GET['exam_type'];

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();


$pdf->SetFont('Arial', 'B', 17);
$headingWidth = $pdf->GetStringWidth('Rajiv Gandhi University Knowledge and Technologies, Basar');

// Calculate the position to center the heading
$headingX = (240 - $headingWidth) / 2;

// Add centered heading "Rajiv Gandhi University" and logo
$pdf->Image('logo.jpg', 0, 8, 40);
$pdf->Text($headingX, 20, 'Rajiv Gandhi University Knowledge and Technologies, Basar');
$pdf->Ln(20);
// Add centered heading "Rajiv Gandhi University"
/*$pdf->Image('logo.jpg', 10, 10, 40);
$pdf->Cell(0, 10, 'Rajiv Gandhi University Knowledge and Technologie, Basar', 0, 1, 'C'); // Bigger heading
$pdf->Ln(10);*/
$pdf->SetFont('Arial', 'B', 16);

// Add centered header "Student Result"
$pdf->Cell(0, 10, 'Student Result', 0, 1, 'C');
$pdf->Ln(10);

// Add student details
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Student ID: $id", 0, 1, 'L');
$pdf->Cell(0, 10, "Class Name: $classname", 0, 1, 'L');
$pdf->Cell(0, 10, "Exam Type: $examType", 0, 1, 'L');
$pdf->Ln(10);

// Create a table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'Subject', 1);
$pdf->Cell(50, 10, 'Marks', 1);
$pdf->Cell(50, 10, 'Grade', 1);
$pdf->Ln();

// Create rows for each subject
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Telugu', 1);
$pdf->Cell(50, 10, $telugu, 1);
$pdf->Cell(50, 10, getGrade($telugu), 1);
$pdf->Ln();

$pdf->Cell(50, 10, 'Hindi', 1);
$pdf->Cell(50, 10, $hindi, 1);
$pdf->Cell(50, 10, getGrade($hindi), 1);
$pdf->Ln();

$pdf->Cell(50, 10, 'English', 1);
$pdf->Cell(50, 10, $english, 1);
$pdf->Cell(50, 10, getGrade($english), 1);
$pdf->Ln();

$pdf->Cell(50, 10, 'Mathematics', 1);
$pdf->Cell(50, 10, $maths, 1);
$pdf->Cell(50, 10, getGrade($maths), 1);
$pdf->Ln();

$pdf->Cell(50, 10, 'Science', 1);
$pdf->Cell(50, 10, $science, 1);
$pdf->Cell(50, 10, getGrade($science), 1);
$pdf->Ln();

$pdf->Cell(50, 10, 'Social', 1);
$pdf->Cell(50, 10, $social, 1);
$pdf->Cell(50, 10, getGrade($social), 1);
$pdf->Ln();

$totalMarks = $telugu + $hindi + $english + $maths + $science + $social;
$totalGrade = getGrade($totalMarks);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'Total', 1);
$pdf->Cell(50, 10, $totalMarks, 1);
$pdf->Cell(50, 10, $totalGrade, 1);
$pdf->Ln();
// Output PDF
$pdf->Output('D', 'student_result.pdf');
// Function to calculate grade based on marks
function getGrade($marks) {
    // Calculate grade logic here and return the calculated grade
    // For example, you can implement the grade logic similar to what you've mentioned before
    if ($marks > 90) {
        return 'EX';
    } elseif ($marks > 80) {
        return 'A';
    } elseif ($marks > 70) {
        return 'B';
    } elseif ($marks > 60) {
        return 'C';
    } elseif ($marks > 50) {
        return 'D';
    } elseif ($marks > 40) {
        return 'P';
    } else {
        return 'R';
    }
}
?>
