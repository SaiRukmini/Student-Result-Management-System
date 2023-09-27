<?php
require 'vendor/autoload.php';
require 'C:\xampp\htdocs\php-practice\project2/db_config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['class_name']) && isset($_POST['exam_type'])) {
        // Retrieve and sanitize the form values
        
    $id = $_POST['id'];
    $classname = $_POST['class_name'];
    $examType = $_POST['exam_type'];
    // Construct the query
    $query = "
    SELECT users.user_name, users.Class, users.name, $examType.telugu,$examType.hindi,$examType.english,$examType.maths, $examType.science,$examType.social
    FROM users
    JOIN $examType ON users.id = $examType.stdid
    WHERE users.id = ?
";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Statement preparation error: " . $conn->error);
    }

    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result !== false) {
        $row = $result->fetch_assoc();
        if ($row) {
            $username = $row['user_name'];
            $telugu = $row['telugu'];
            $hindi = $row['hindi'];
            $english = $row['english'];
            $maths = $row['maths'];
            $science = $row['science'];
            $social = $row['social'];
            if($telugu>90||$hindi>90||$english>90||$maths>90||$science>90||$social>90)
            {
                $G="EX";
            }
            else if(($telugu>80&&$telugu<=90)||($hindi>80&&$hindi<=90)||($english>80&&$english<=90)||($maths>80&&$maths<=90)||($science>80&&$science<=90)||($social>80&&$social<=90))
            {
                $G="A";
            }
            else if(($telugu>70&&$telugu<=80)||($hindi>70&&$hindi<=80)||($english>70&&$english<=80)||($maths>70&&$maths<=80)||($science>70&&$science<=80)||($social>70&&$social<=80))
            {
                $G="B";
            }
            else if(($telugu>60&&$telugu<=70)||($hindi>60&&$hindi<=70)||($english>60&&$english<=70)||($maths>60&&$maths<=70)||($science>60&&$science<=70)||($social>60&&$social<=70))
            {
                $G="C";
            }
            else if(($telugu>50&&$telugu<=60)||($hindi>50&&$hindi<=60)||($english>50&&$english<=60)||($maths>50&&$maths<=60)||($science>50&&$science<=60)||($social>50&&$social<=60))
            {
                $G="D";
            }
            else if(($telugu>=40&&$telugu<=50)||($hindi>=40&&$hindi<=50)||($english>=40&&$english<=50)||($maths>=40&&$maths<=50)||($science>=40&&$science<=50)||($social>=40&&$social<=50))
            {
                $G="P";
            }
            else{
                $G="R";
            }

            //echo "Student Username: $username<br>";
            //echo "Class: $class<br>";
            //echo "Name: $name<br>";
            //echo "Maths: $maths<br>";
            //echo "Physics: $physics<br>";
        } else {
            echo "No records found for the given student.";
        }
    } else {
        die("Query execution error: " . $stmt->error);
    }

    $stmt->close();

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="extralogin.css">
    </head>

    <body>
        <section class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">&#8801;</button>
                        <div id="myDropdown" class="dropdown-content">
                            <ul class="navi">
                                <li>
                                    <a href="home.html">
                                        <i class="fa fa-fw fa-home" style="font-size:40px;" id="icon">
                                            <div class="circle"></div>
                                        </i>
                                        <div class="title">Home</div>
                                    </a>
                                </li>

                                <li>
                                    <a href="admin.html">
                                        <i class="fa fa-fw fa-user" style="font-size:40px" id="icon">
                                            <div class="circle"></div>
                                        </i>
                                        <div class="title">Admin</div>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://codepen.io/ladyjellington">
                                        <i class="fa fa-fw fa-envelope" style="font-size:40px" id="icon">
                                            <div class="circle"></div>
                                        </i>
                                        <div class="title">Contact</div>
                                    </a>
                                </li>

                                <li>
                                    <a href="user.html">
                                        <i class="fa fa-fw fa-user" style="font-size:40px" id="icon">
                                            <div class="circle"></div>
                                        </i>
                                        <div class="title">Login</div>
                                    </a>
                                </li>
                                <div class="background"></div>

                            </ul>
                        </div>
                    </div>
                    <?php
                    echo '<script type="text/javascript">myFunction();</script>';
                    ?>
                    <script type="text/javascript">
                        /* When the user clicks on the button, 
                        toggle between hiding and showing the dropdown content */
                        function myFunction() {
                            document.getElementById("myDropdown").classList.toggle("show");
                        }

                        // Close the dropdown if the user clicks outside of it
                        window.onclick = function (event) {
                            if (!event.target.matches('.dropbtn')) {
                                var dropdowns = document.getElementsByClassName("dropdown-content");
                                var i;
                                for (i = 0; i < dropdowns.length; i++) {
                                    var openDropdown = dropdowns[i];
                                    if (openDropdown.classList.contains('show')) {
                                        openDropdown.classList.remove('show');
                                    }
                                }
                            }
                        }
                    </script>
                </div>
                <div class="col-md-10  ">
                    <div class="container h-100">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-9">

                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center pt-1 pb-1">

                                            <div class="col-md-5 ps-5">

                                                <h6 class="mb-0" style="color:white;">User name</h6>

                                            </div>
                                            <div class="col-md-7 pe-5">

                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="<?php echo  $username; ?>" />

                                            </div>
                                        </div>

                                        <hr class="mx-n3">

                                        <div class="row align-items-center py-1">
                                            <div class="col-md-5 ps-5">

                                                <h6 class="mb-0" style="color:black;">Telugu</h6>

                                            </div>
                                            <div class="col-md-5 pe-5">

                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="<?php echo $telugu; ?>" />

                                            </div>
                                        </div>
                                        <div class="row align-items-center py-1">
                                            <div class="col-md-5 ps-5">

                                                <h6 class="mb-0" style="color:black;">Hindi</h6>

                                            </div>
                                            <div class="col-md-5 pe-5">

                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="<?php echo $hindi; ?>" />

                                            </div>
                                        </div>
                                        <div class="row align-items-center py-1">
                                            <div class="col-md-5 ps-5">

                                                <h6 class="mb-0" style="color:black;">English</h6>

                                            </div>
                                            <div class="col-md-5 pe-5">

                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="<?php echo $english; ?>" />

                                            </div>
                                        </div>
                                        <div class="row align-items-center py-1">
                                            <div class="col-md-5 ps-5">

                                                <h6 class="mb-0" style="color:black;">Mathematics</h6>

                                            </div>
                                            <div class="col-md-5 pe-5">

                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="<?php echo $maths; ?>" />

                                            </div>
                                        </div>

                                        <div class="row align-items-center py-1">
                                            <div class="col-md-5 ps-5">

                                                <h6 class="mb-0" style="color:black;">Science</h6>

                                            </div>
                                            <div class="col-md-5 pe-5">

                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="<?php echo $science; ?>" />

                                            </div>
                                        </div>
                                        <div class="row align-items-center py-1">
                                            <div class="col-md-5 ps-5">

                                                <h6 class="mb-0" style="color:black;">Social</h6>

                                            </div>
                                            <div class="col-md-5 pe-5">

                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="<?php echo $social; ?>" />

                                            </div>
                                        </div>
                                        <hr class="mx-n3">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {
    echo "Please provide id parameter.";
}}

$conn->close();
?>
