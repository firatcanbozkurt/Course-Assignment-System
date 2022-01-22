<?php 

include 'C:\xampp\htdocs\add_config.php';


session_start();
if($_SESSION['auth_admin']!=1){
  
header("Location:redirect.php");

}
include 'add_config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courser-master</title>
    <link rel="stylesheet" href="style/taken_courses_style.css" />
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
      

  
  </div>
   
  </body>
</html>
<?php
$course_info = "SELECT * FROM registired_students";
$course_query = mysqli_query($conn,$course_info);
if($course_query->num_rows>0){
  echo "<div class='courses_div'><em><p style='color:green; border:2px white solid;font-weight:bold;text-align:center;border-radius:15px;font-size:1.2em;'>Course taken students</p></em><table id ='course_table'><tr><th>Course ID</th><th>Studentd ID</th></tr>";
  while($row = $course_query->fetch_assoc()){
    echo "<tr><td>".$row["courseid"]."</td>
    <td>".$row["studentid"]."</td></tr>";
    
  }
  echo '</table></div>';
}
$course_info_all = "SELECT * FROM coursesinfo";
$course_query_all = mysqli_query($conn,$course_info_all);
if($course_query_all->num_rows>0){
  echo "<div class='courses_div2'><em><p style='color:green; border:2px white solid;font-weight:bold;text-align:center;border-radius:15px;font-size:1.2em;'>Courses info</p></em><table id ='course_table'><tr><th>Course name</th><th>Credit</th><th>Capacity</th>
    <th>Current Capacity</th><th>Course id</th></tr>";
  while($row = $course_query_all->fetch_assoc()){
    echo "<tr><td>".$row["coursename"]."</td>
    <td>".$row["credit"]."</td><td>".$row["capacity"]."</td>
    <td>".$row["current"]."</td><td>".$row["courseid"]."</td></tr>";
    
  }
  echo '</table></div>';
}

?>



