<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['admin_name']) && isset($_SESSION['Designation']) && isset($_SESSION['Subject'])) {

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <link rel="stylesheet" href="extralogin.css">
    </head>

    <body>
        <section class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">&#8801;</button>
                        <div id="myDropdown" class="dropdown-content">
                            <ul class="navi">
                                <li >
                                    <a href="home.html" >
                                        <i class="fa fa-fw fa-home" style="font-size:40px;" id="icon">
                                            <div class="circle"></div>
                                        </i>
                                        <div class="title">Home</div>
                                    </a>
                                </li>

                                <li>
                                    <a href="admin.html" >
                                        <i class="fa fa-fw fa-user" style="font-size:40px" id="icon">
                                            <div class="circle"></div>
                                        </i>
                                        <div class="title">Admin</div>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://codepen.io/ladyjellington"  >
                                        <i class="fa fa-fw fa-envelope" style="font-size:40px" id="icon">
                                            <div class="circle"></div>
                                        </i>
                                        <div class="title">Contact</div>
                                    </a>
                                </li>

                                <li>
                                    <a href="login.html" >
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
                <div class="col-md-9  " >
                    <div class="container h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-md-7">

                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center pt-4 pb-3">
                                            <div class="col-md-3 ps-5">

                                                <h6 class="mb-0">Full name</h6>

                                            </div>
                                            <div class="col-md-9 pe-5">

                                                <input type="text" class="form-control form-control-lg"
                                                    placeholder="<?php echo $_SESSION['name']; ?>" />

                                            </div>
                                        </div>

                                        <hr class="mx-n3">

                                        <div class="row align-items-center py-3">
                                            <div class="col-md-3 ps-5">

                                                <h6 class="mb-0">Email address</h6>

                                            </div>
                                            <div class="col-md-9 pe-5">

                                                <input type="email" class="form-control form-control-lg"
                                                    placeholder="<?php echo $_SESSION['Designation']; ?>" />

                                            </div>
                                        </div>

                                        <hr class="mx-n3">

                                        <div class="row align-items-center py-3">
                                            <div class="col-md-3 ps-5">

                                                <h6 class="mb-0">Subject Name</h6>

                                            </div>
                                            <div class="col-md-9 pe-5">

                                                <input type="email" class="form-control form-control-lg"
                                                    placeholder="<?php echo $_SESSION['Subject']; ?>" />

                                            </div>
                                        </div>

                                        <hr class="mx-n3">
                                        <div class="row align-items-center py-3">
                                            <div class="col-md-6 ps-5">

                                                <a href=" adminlogout.php"><button type="submit"
                                                        class="btn btn-primary btn-lg">Logout</button></a>
                                            </div>
                                            <div class="col-md-6 ps-5">

                                                <a href=" insert.php"><button type="submit"
                                                        class="btn btn-primary btn-lg">Logout</button></a>
                                            </div>
                                        </div>


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