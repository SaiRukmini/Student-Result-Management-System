<html lang="en">
   <head>
      <title>Sample Form</title>
   </head>
   <body>
      <center>
         <h1>Updation Form</h1>
         <form action="index.php" method="post">
         <div class="user-box">
            <input type="text" name="id" required="">
            <label>Id</label>
          </div><br>
          <div class="user-box">
            <input type="text" name="Subject" placeholder="Subject" required="">
            <label>Subject</label>
         </div>
          <div class="user-box">
            <input type="text" name="Marks" required="">
            <label>Marks</label>
          </div>

          <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <input type="submit" name="update" value="Update">
          </a>
         </form>
      </center>
   </body>
</html>