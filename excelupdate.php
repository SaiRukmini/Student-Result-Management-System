<?php
require 'vendor/autoload.php';
require 'C:\xampp\htdocs\php-practice\project2/db_config.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
echo "iam here" ;
if (isset($_POST['submit'])) {
    //$mimes = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.oasis.opendocument.spreadsheet'];
    echo "iam here" ;
    $mimes = [
        'application/vnd.ms-excel',        // MIME type for .xls files
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // MIME type for .xlsx files
        'text/xls', 'text/xlsx', 'application/vnd.oasis.opendocument.spreadsheet'
    ];
    // After the move_uploaded_file function, add these lines to check the file path and existence.
    if (in_array($_FILES["file"]["type"], $mimes)) {
        $uploadFilePath = 'uploads/' . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
        echo "Uploaded file path: " . $uploadFilePath;
        echo "File exists: " . (file_exists($uploadFilePath) ? "Yes" : "No");
        $spreadsheet = IOFactory::load($uploadFilePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        $count = 0;
        for ($row = 2; $row <= $highestRow; ++$row) { // Starting from row 2 to skip the header row
            $classid = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $stdid = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $maths = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $physics = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

            // Assuming $conn is the mysqli connection object from db_config.php
            $query = "UPDATE halfyearly SET maths = ?, physics = ? WHERE classid = ? AND stdid = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $maths, $physics, $classid, $stdid);
            $result = $stmt->execute();
            echo "iam here";
            echo "$result<br>$count";
            if ($result) {
                $count++;
            }
            if (!$result) {
                die("Error: " . $conn->error);
            }

        }

        echo "<br> Data updated in the database. Total records updated: " . $count;
    } else {
        die("<br>Sorry, File type is not allowed. Only Excel files are allowed.");
    }

    $conn->close();
}
?>