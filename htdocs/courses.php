<?php
session_start();
if($_SESSION['auth']!=1){
  
header("Location:redirect.php");

}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style/coursesst.css" />
  </head>
  <body>
    <div class="container">
      <div id="nav-bar">
        <ul id="nav-ul">
          <li class="left-side"><a href="login.php">Courser-Master</a></li>
          <li class="right-side"><a href="account.php">Account</a></li>
          <li class="right-side"><a href="courses.php">Courses</a></li>
        </ul>
      </div>
    </div>
    <div class="course-page">
      <ul>
        <li><a href="">Linear Algebra and differential equations</a></li>
      </ul>
    </div>
  </body>
</html>



<?php 

include 'C:\xampp\htdocs\add_config.php';



error_reporting(0);
$bringcourses = "SELECT coursename,credit,capacity FROM coursesinfo";

$result1 = mysqli_query($conn,$bringcourses);
  echo '<div class="course-page">
      <ul>';
        
  while($row = $result1->fetch_assoc()) {
    
    echo "<p>Coursename: " . $row["coursename"]. " - Credit: " . $row["credit"]. " - Capacity: " . $row["capacity"]. "</p><br><br></li>";
  }
  echo '</ul></div>'



?>



