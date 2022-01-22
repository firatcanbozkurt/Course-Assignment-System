<?php 

include 'C:\xampp\htdocs\add_config.php';


session_start();
if($_SESSION['auth_admin']!=1){
  
header("Location:redirect.php");

}





error_reporting(0);
if (isset($_POST['submit'])) {
  $coursename = $_POST['coursename'];
  $credit = $_POST['credit'];
  $capacity = $_POST['capacity'];
  $courseid = $_POST['courseid'];
  $current = 0;
  $course_id_check="SELECT courseid FROM coursesinfo WHERE courseid='$courseid'";
  $course_id_result = mysqli_query($conn,$course_id_check);
  if(!$course_id_result->num_rows>0){
    $sql = "SELECT * FROM coursesinfo WHERE coursename='$coursename'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
    $sql = "INSERT INTO coursesinfo (coursename,credit,capacity,courseid,current)
        VALUES('$coursename','$credit', '$capacity','$courseid','$current')";
      if(mysqli_query($conn, $sql)){
  	  echo "<script>alert('$coursename course is added to the database')</script>";
      }else{
      echo "failed";
      }
    }
  }
else{
  echo "<script>alert('$courseid course is already exist!')</script>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courser-master</title>
    <link rel="stylesheet" href="style/add_course_style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
  </head>
  <body>
  
    <div class="container">
      <div id="nav-bar">
        <ul id="nav-ul">
          <li class="left-side"><a href="add_course.php">🌀Courser-Master</a></li>
          <li class="right-side"><a href="logout.php">➡️Log Out</a></li>
          <li class="right-side"><a href="taken_courses.php">📘Taken courses</a></li>
          <li class="right-side"><a href="add_course.php">📊Add courses</a></li>
          
        </ul>
      </div>
    </div>
      

      
    <div id="course_form">
      
      <form id="loginform" action="" method="POST">
    
    <input class="inputs"type="text" autocomplete="off" name="coursename" placeholder="Coursename" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    >
    <input class="inputs"type="text" autocomplete="off" name="credit" placeholder="Credit" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    >
    <input class="inputs"type="text" autocomplete="off" name="capacity" placeholder="Capacity" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    >
    <input class="inputs"type="text" autocomplete="off" name="courseid" placeholder="Course ID" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    >
    
    <br><input class="inputs" id="regbtn"type="submit" name="submit" id="loginbtn"value="Create course!" >
    
  </form>
  </div>
   
  </body>
</html>
