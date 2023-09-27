<?php
include 'db_con_admin.php';
if(isset($_POST['id']) && isset($_POST['Marks']))
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
            $id =validate($_POST['id']);
            $Marks =validate($_POST['Marks']);
            $Subject=validate($_POST['Subject']);
            if(empty($id))
            {
                header("Location: admin.html?error=Id is required");
                exit();
            }
            else if(empty($Marks))
            {
                header("Location: admin.html?error=Marks is required");
                exit();
            }
            else
            {
                $sql = "SELECT id FROM users WHERE id='$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                 // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo "id: " . $row["id"];
                  if($Subject=='Artificial Intelligence'){
                  $sql = "update users set CS2041='$Marks' where id='$id'";
                  }
                  else if($Subject=='DIP'){
                    $sql = "update users set CS3243='$Marks' where id='$id'";
                    }
                if ($conn->query($sql) === TRUE) {
                    echo "Records updated ";
                } else {
                    echo "Error: ".$sql."<br>".$conn->error;
                }
                  }
                } else {
                 echo "No records Found";
                }
            }
    }
    else
    {
        header("Location: insertnew.php?error=Incorrect Id");
        exit();
    }
?>