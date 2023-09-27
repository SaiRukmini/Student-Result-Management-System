<?php 
session_start();
include "db_con_admin.php";

    if(isset($_POST['uname']) && isset($_POST['password']))
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
            $uname =validate($_POST['uname']);
            $pass=validate($_POST['password']);
            if(empty($uname))
            {
                header("Location: admin.html?error=Admin Name is required");
                exit();
            }
            else if(empty($pass))
            {
                header("Location: admin.html?error=Password is required");
                exit();
            }
            else
            {
              $sql ="SELECT * FROM admin WHERE admin_name='$uname' AND password='$pass'";
              $result = mysqli_query($conn,$sql);
              if(mysqli_num_rows($result) == 1 )
              {
                $row = mysqli_fetch_assoc($result);
                 if($row['admin_name'] === $uname && $row['password'] === $pass)
                 {
                         $_SESSION['admin_name'] = $row['admin_name'];
                         $_SESSION['name'] = $row['name'];
                         $_SESSION['id'] = $row['id'];
                         $_SESSION['Designation'] = $row['Designation'];
                         $_SESSION['Subject'] = $row['Subject'];
                         header("Location: adminhome.php");
                      exit();

                 }
                 else
                 {
                      header("Location: admin.html?error= Incorrect admin name or password");
                      exit();
                 }
               
              }
              else
              {
                header("Location: admin.html?error= Incorrect admin name or password");
                exit();
              }
            }
    }
    else
    {
        header("Location: admin.html");
        exit();
    }
 ?>