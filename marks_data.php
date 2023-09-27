<?php
// Include the database configuration
require 'C:\xampp\htdocs\php-practice\project2/db_config.php';

$telugu = $hindi = $english = $maths = $science = $social = 0; // Initialize the variables

if (isset($_POST['id']) && isset($_POST['class_name']) && isset($_POST['exam_type'])) {
    // Retrieve and sanitize the form values
    $id = $_POST['id'];
    $classname = $_POST['class_name'];
    $examType = $_POST['exam_type'];

    // Construct the query
    $query = "
        SELECT users.user_name, users.Class, users.name, $examType.telugu, $examType.hindi, $examType.english, $examType.maths, $examType.science, $examType.social
        FROM users
        JOIN $examType ON users.id = $examType.stdid
        WHERE users.id = ?
    ";

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false) {
        $row = $result->fetch_assoc();
        if ($row) {
            $telugu = $row['telugu'];
            $hindi = $row['hindi'];
            $english = $row['english'];
            $maths = $row['maths'];
            $science = $row['science'];
            $social = $row['social'];

            // Calculate GPA and grade here
            // ...

            // Close the statement
            $stmt->close();
        }
    }
}
?>
