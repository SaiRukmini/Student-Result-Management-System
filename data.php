
<?php

require 'db_config.php';
require 'vendor/autoload.php'; // Include PHPSpreadsheet library

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
ob_start();
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$rows = mysqli_query($conn, "SELECT * FROM halfyearly");
$rowIndex = 1;
$rowCount = 0;
while ($row = mysqli_fetch_assoc($rows)) {
    $rowCount++;
    $sheet->setCellValue('A' . $rowIndex, $row["classid"]);
    $sheet->setCellValue('B' . $rowIndex, $row["stdid"]);
    $sheet->setCellValue('C' . $rowIndex, $row["maths"]);
    $sheet->setCellValue('D' . $rowIndex, $row["physics"]);
    print_r($row);
    $rowIndex++;
}
echo "Total rows fetched: $rowCount";
$writer = new Xls($spreadsheet);
$filename = 'student_data.xls';
$writer->save($filename);

// Set headers to download the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Output the file to the browser
$writer->save('php://output');

// Close the database connection
$conn->close();
ob_end_clean();

exit;

?>