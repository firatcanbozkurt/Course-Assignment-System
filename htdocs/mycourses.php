<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courser-master</title>
    <link rel="stylesheet" href="style/reg.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
  </head>
  <body>
  
    <div class="container">
      <div id="nav-bar">
        <ul id="nav-ul">
          <li class="left-side"><a href="welcome.php">🌀Courser-Master</a></li>
          <li class="right-side"><a href="logout.php">➡️Log Out</a></li>
          <li class="right-side"><a href="account.php">🔑Account</a></li>
          <li class="right-side"><a href="registiration.php">➕Register Courses</a></li> 
          <li class="right-side"><a href="mycourses.php">📘My Courses</a></li>
        </ul>
      </div>
    </div>
    <div class="course-page">
      <form id="register"action="" method="post">
        <input class="inputs"type="text" name="courseid"placeholder="Course ID" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
      
        
        <button id="regbtn"class="inputs"type="submit" name='submit'>Drop the course</button>
       <br><br><br><br>
      </form> 
      
    </div>
  </body>
</html>


<?php
session_start();
if($_SESSION['auth']!=1){
  session_destroy();
header("Location:redirect.php");

}
  $current_username = $_SESSION['username'];
  $studentid = $current_username;
  if(isset($_POST['submit2'])){
    session_start();
    session_destroy();
    
    header("Location: index.php");
  }
  include 'add_config.php';
  $course_info = "SELECT * FROM registired_students WHERE studentid='$studentid'";
  $course_query = mysqli_query($conn,$course_info);
  if($course_query->num_rows>0){
    echo "<p id='your-course'>Your Courses</p><div class='courses_div'><table id ='course_table'><tr><th>Course Id</th></tr>";
    while($row = $course_query->fetch_assoc()){
      echo "<tr><td>".$row["courseid"]."</td></tr>";
      
    }
    echo '</table></div>';
  }
  if(isset($_POST['submit'])){
    
    $courseid = $_POST['courseid'];
    $check = "SELECT * FROM registired_students WHERE courseid='$courseid' AND studentid='$studentid'";
    $result23 = mysqli_query($conn,$check);
    if($result23->num_rows>0){
      $delete = "DELETE FROM registired_students WHERE courseid='$courseid' AND studentid='$studentid'";
      mysqli_query($conn,$delete);
      $capacity_dec="SELECT current FROM coursesinfo WHERE courseid='$courseid'";
      $capacity_dec_result = mysqli_query($conn,$capacity_dec);
      if($capacity_dec_result->num_rows>0){
        while($current = $capacity_dec_result->fetch_assoc()){
          $current_capacity = $current['current'] - 1;
          $update_capacity = "UPDATE coursesinfo SET current='$current_capacity' WHERE courseid='$courseid'";
          mysqli_query($conn,$update_capacity);
          echo "<script>alert('Course has dropped!')</script>";
          break;
        }
      }
    }
  }
?>