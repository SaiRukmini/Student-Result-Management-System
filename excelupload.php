<?php
require 'vendor/autoload.php';
require 'C:\xampp\htdocs\php-practice\project2/db_config.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submit'])) {
    $subject = $_POST['subject_name'];
    $selectedClass = $_POST['class_name'];
    $examType = $_POST['exam_type'];
    //$mimes = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.oasis.opendocument.spreadsheet'];
    $mimes = [
        'application/vnd.ms-excel',
        // MIME type for .xls files
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        // MIME type for .xlsx files
        'text/xls',
        'text/xlsx',
        'application/vnd.oasis.opendocument.spreadsheet'
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
        // ... (previous code remains the same)

        for ($row = 2; $row <= $highestRow; ++$row) {
            $classid = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $stdid = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $marks = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            //$physics = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

            // Check if the record already exists
            $checkQuery = "SELECT COUNT(*) FROM $examType WHERE classid = ? AND stdid = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("ss", $classid, $stdid);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            $existingRecordCount = $checkResult->fetch_row()[0];
            $checkStmt->close();

            if ($existingRecordCount > 0) {
                // Update the existing record
                $updateQuery = "UPDATE $examType SET $subject = ? WHERE classid = ? AND stdid = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("dss", $marks, $classid, $stdid);
                $result = $updateStmt->execute();
                $updateStmt->close();
            } else {
                // Insert a new record
                $insertQuery = "INSERT INTO $examType (classid, stdid, $subject) VALUES (?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("ssd", $classid, $stdid, $marks);
                $result = $insertStmt->execute();
                $insertStmt->close();
            }

            if ($result) {
                $count++;
            } else {
                die("Error: " . $conn->error);
            }
           /* $checkQueryClass1 = "SELECT COUNT(*) FROM $selectedClass WHERE classid = ? AND stdid = ?";
            $checkStmtClass1 = $conn->prepare($checkQueryClass1);
            $checkStmtClass1->bind_param("ss", $classid, $stdid);
            $checkStmtClass1->execute();
            $checkResultClass1 = $checkStmtClass1->get_result();
            $existingRecordCountClass1 = $checkResultClass1->fetch_row()[0];
            $checkStmtClass1->close();

            if ($existingRecordCountClass1 > 0) {
                // Update the existing record in class1 table
                $updateQueryClass1 = "UPDATE $selectedClass SET $subject= ? WHERE classid = ? AND stdid = ?";
                $updateStmtClass1 = $conn->prepare($updateQueryClass1);
                $updateStmtClass1->bind_param("dss", $marks, $classid, $stdid);
                $resultClass1 = $updateStmtClass1->execute();
                $updateStmtClass1->close();
            } else {
                // Insert a new record into class1 table
                $insertQueryClass1 = "INSERT INTO $selectedClass (classid, stdid, $subject) VALUES (?, ?, ?)";
                $insertStmtClass1 = $conn->prepare($insertQueryClass1);
                $insertStmtClass1->bind_param("ssd", $classid, $stdid, $marks);
                $resultClass1 = $insertStmtClass1->execute();
                $insertStmtClass1->close();
            }
            // ...*/

            // Check if the record already exists
            $checkQuery = "SELECT COUNT(*) FROM $examType WHERE classid = ? AND stdid = ?";
            $checkStmt = $conn->prepare($checkQuery);

            if (!$checkStmt) {
                die("Error in preparing check statement: " . $conn->error);
            }

            $checkStmt->bind_param("ss", $classid, $stdid);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            $existingRecordCount = $checkResult->fetch_row()[0];
            $checkStmt->close();

            // ...


            // ... (rest of the code remains the same)




            // ... (rest of the code remains the same)
        }

        echo "<br> Data updated in the database. Total records updated: " . $count;
    } else {
        die("<br>Sorry, File type is not allowed. Only Excel files are allowed.");
    }

    $conn->close();
}
?>