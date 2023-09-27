<?php
session_start();
if (isset($_SESSION['id'])) {

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <link rel="stylesheet" href="extra.css">
        <style>
    .white-border {
      border-color: white;
    }
  </style>
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
                            <div class="col-md-7">

                                <div class="card">
                                    <div class="card-body">

                                        <form method="POST" action="view_marks1.php" enctype="multipart/form-data">
                                        <div class="row align-items-center py-3">
                                            <div class="col-md-5 ps-5">

                                                <h6 class="mb-0" style="color:white;">Id</h6>

                                            </div>
                                            <div class="col-md-7 pe-5">

                                                <input type="text" class="form-control form-control-sm"
                                                   name="id"  placeholder="Enter Id" />

                                            </div>
                                        </div>

                                                <div class="row align-items-center py-3">
                                                    <div class="col-md-5 ps-5">

                                                        <h6 class="mb-0" style="color:white;">Class Name</h6>

                                                    </div>
                                                    <div class="col-md-7 pe-5">

                                                    <select name="class_name" id="class_name" class="form-control">
                                                        <option value="select classt">Select Class</option>
                                                        <option value="E4_class1">E4_class1</option>
                                                        <option value="E4_class2">E4_class2</option>
                                                        <option value="E4_class3">E4_class3</option>
                                                        <option value="E4_class4">E4_class4</option>
                                                        <option value="E4_class5">E4_class5</option>
                                                        <option value="E3_class5">E3_class5</option>
                                                        <!-- Add more class options as needed -->
                                                    </select>

                                                    </div>
                                                </div>
                                                <div class="row align-items-center py-3">
                                                    <div class="col-md-5 ps-5">

                                                        <h6 class="mb-0" style="color:white;">Exam Type</h6>

                                                    </div>
                                                    <div class="col-md-7 pe-5">

                                                    <select name="exam_type" id="exam_type" class="form-control">
                                                        <option value="select type">Select Exam Type</option>
                                                        <option value="mt1_sem1">mt1_sem1</option>
                                                        <option value="mt2_sem1">mt2_sem1</option>
                                                        <option value="mt3_sem1">mt3_sem1</option>
                                                        <option value="mt1_sem2">mt1_sem2</option>
                                                        <option value="mt2_sem2">mt2_sem2</option>
                                                        <option value="mt3_sem2">mt3_sem2</option>
                                                        <!-- Add more class options as needed -->
                                                    </select>

                                                    </div>
                                                </div>
                                                <div class="row align-items-center py-3">
                                                <div class="col-md-5 ps-5">

                                                    <button type="submit"
                                                            class="btn border white-border btn-sm">Check Marks</button>
                                                </div>
                                            </div>
                                            </div>
                                            <hr>

                                            <?php require 'data.php'; ?>
                                        </form>

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
    header("Location: admin.html");
    exit();
} ?>