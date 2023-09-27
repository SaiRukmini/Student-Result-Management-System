<?php
require 'vendor/autoload.php';
require 'C:\xampp\htdocs\php-practice\project2/db_config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!isset($_GET['class']) || !isset($_GET['subject']) || !isset($_GET['exam'])) {
    die("Class, subject, or exam parameter not provided in the URL.");
}

$selectedClass = $_GET['class'];
$selectedSubject = $_GET['subject'];
$selectedType = $_GET['exam'];

// Define valid subject columns to prevent SQL injection
$validSubjectColumns = array('telugu', 'hindi', 'english', 'maths', 'science', 'social');

if (!in_array($selectedSubject, $validSubjectColumns)) {
    die("Invalid subject selected.");
}

// Rest of your code here...
$query = "SELECT * FROM $selectedType WHERE classid = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error preparing the statement: " . $conn->error);
}
$stmt->bind_param("s", $selectedClass);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

// Create a new spreadsheet
$spreadsheet= new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers
$sheet->setCellValue('A1', 'classid');
$sheet->setCellValue('B1', 'stdid');
$sheet->setCellValue('C1', $selectedSubject); // Set the selected subject as the column header

// Populate the spreadsheet with data
$rowIndex = 2; // Start from row 2
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowIndex, $row['classid']);
    $sheet->setCellValue('B' . $rowIndex, $row['stdid']);
    $sheet->setCellValue('C' . $rowIndex, $row[$selectedSubject]); // Populate the selected subject's data
    $rowIndex++;
}

// Save the spreadsheet to a file
$writer = new Xlsx($spreadsheet);
$filename = 'student_data.xlsx';
$writer->save($filename);

// Set headers to download the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Output the file to the browser
$writer->save('php://output');

// Close the database connection
$conn->close();
?>
