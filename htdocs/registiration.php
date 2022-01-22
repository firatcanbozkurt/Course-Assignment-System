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
        <p class="input_text" style="border: 2px white solid; text-align:center; border-radius: 15px;">Register A Course</p>
        <input class="inputs"type="text" name="courseid"placeholder="Course ID" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
      
        <input class="inputs"type="text" name="studentid"placeholder="Student ID"required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')" >
        <button id="regbtn"class="inputs"type="submit" name='submit'>📌 Register!</button>
       <br><br><br><br>
      </form>

      <form id="register2"action="" method="post">
        <p class="input_text"style="border: 2px white solid; text-align:center; border-radius: 15px;">Swap courses</p>
        <input class="inputs"type="text" name="first_courseid"placeholder="Current Course ID" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
        <input class="inputs"type="text" name="first_studentid"placeholder="Current Student ID"required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
        <input class="inputs"type="text" name="second_courseid"placeholder="Required Course ID"required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
        <input class="inputs"type="text" name="second_studentid"placeholder="Second Student ID"required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
        <button class="inputs" id="regbtn"type="submit" name='submit_change'>🤝 Send a Swap Request</button>

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

  if(isset($_POST['submit2'])){
    session_start();
    session_destroy();
    
    header("Location: index.php");
  }
  include 'add_config.php';
  $course_info = "SELECT * FROM coursesinfo";
  $course_query = mysqli_query($conn,$course_info);
  if($course_query->num_rows>0){
    echo "<div class='courses_div'><table id ='course_table'><tr><th>Course name</th><th>Credit</th><th>Capacity</th>
      <th>Current Capacity</th><th>Course id</th></tr>";
    while($row = $course_query->fetch_assoc()){
      echo "<tr><td>".$row["coursename"]."</td>
      <td>".$row["credit"]."</td><td>".$row["capacity"]."</td>
      <td>".$row["current"]."</td><td>".$row["courseid"]."</td></tr>";
      
    }
    echo '</table></div>';
    if(isset($_POST['submit'])){
      header("Refresh:0");
      $courseid = $_POST['courseid'];
      $studentid = $_POST['studentid'];
      $capacity_check = "SELECT current ,capacity FROM coursesinfo WHERE courseid='$courseid'";
      $capacity_check_result = mysqli_query($conn,$capacity_check);
      $session_username = $_SESSION['username'];
      if($studentid == $session_username){
        if($capacity_check_result->num_rows>0){
          while($row = $capacity_check_result->fetch_assoc()){
            if($row["current"] < $row["capacity"]){
              $check_student = "SELECT studentid FROM registired_students WHERE studentid='$studentid' AND courseid='$courseid'";
              $result_student = mysqli_query($conn,$check_student);
              if($result_student->num_rows<1){
              $insert_student = "INSERT INTO registired_students(courseid,studentid)
              VALUES ($courseid,$studentid)";
               mysqli_query($conn,$insert_student);
               $current_capacity = $row["current"] + 1;
                $current_insert = "UPDATE coursesinfo SET current='$current_capacity' WHERE  courseid='$courseid'";
               mysqli_query($conn,$current_insert);
              
               echo "<script>alert('Registiration completed!')</script>"; 
             }
              else{
               echo "<script>alert('$studentid already registired!')</script>";

             }
            }
           else{
              echo "<script>alert('Course capacity is FULL !')</script>";
           }
         }
        }
          else{
            echo "<script>alert('The course does not exist!')</script>";
          }
      }
      else{
        echo "<script>alert('You can just register for yourself!')</script>";
      }
    }
  }
  $request_student = $_SESSION['username'];
  
  $check_request = "SELECT * FROM course_change WHERE 
  second_studentid='$request_student'";
  $course_request_result = mysqli_query($conn,$check_request);
  if($course_request_result->num_rows>0){
    while($row = $course_request_result->fetch_assoc()){
        $first_req_student = $row["first_studentid"];
        $first_req_course = $row["current_courseid"];
        $required_req_course = $row["required_courseid"];
        
        echo "<br><br><div id='accept_id'><form id='accept' method='post' action=''>
              <p style='display:block; margin-left:38%;'>$first_req_student want to swap his course: $first_req_course with your course: 
              $required_req_course
              </p><br>
              <button class='inputs'id='regbtn' type='submit' name='accept_submit'>Accept</button>
              <button class='inputs'id='regbtn' type='submit' name='decline'>Decline</button>
        </form></div>";

    }
    

  }
  if(isset($_POST['accept_submit'])){
    
      $update_data = "UPDATE registired_students SET studentid='$request_student' WHERE studentid='$first_req_student' AND courseid='$first_req_course'";
      $update_data_result = mysqli_query($conn, $update_data);
      $update_data2= "UPDATE registired_students SET studentid='$first_req_student' WHERE studentid='$request_student' AND courseid='$required_req_course'";
      $update_data2_result = mysqli_query($conn,$update_data2);
      if($update_data2_result){
        $delete_course_request = "DELETE FROM course_change WHERE first_studentid='$first_req_student' AND
        current_courseid='$first_req_course' AND second_studentid='$request_student' AND required_courseid='$required_req_course'";
        mysqli_query($conn,$delete_course_request);
        echo "<script>alert('Course swap has done!')</script>";
       
      }
      

    
  }
  if(isset($_POST['decline'])){
    
    $delete_course_request = "DELETE FROM course_change WHERE first_studentid='$first_req_student' AND
        current_courseid='$first_req_course' AND second_studentid='$request_student' AND required_courseid='$required_req_course'";
        mysqli_query($conn,$delete_course_request);
        echo "<script>alert('Course swap has declined!')</script>";
  }
  
  

  if(isset($_POST['submit_change'])){

    $current_courseid = $_POST['first_courseid'];
    $first_studentid = $_POST['first_studentid'];
    $required_courseid = $_POST['second_courseid'];
    $second_studentid = $_POST['second_studentid'];

    
    $capacity_check_for_current = "SELECT current ,capacity FROM coursesinfo WHERE courseid='$required_courseid'";
    $capacity_check_result_for_current = mysqli_query($conn,$capacity_check_for_current);
    $check_student = "SELECT studentid FROM registired_students WHERE 
    studentid='$first_studentid' AND courseid='$required_courseid'";
    $result_student = mysqli_query($conn,$check_student);

    if($result_student->num_rows>0){
      echo "<script>alert('You already registired to required course')</script>";
    }
    else{
    if($capacity_check_result_for_current->num_rows>0){
      while($row = $capacity_check_result_for_current->fetch_assoc()){
        if($row['current'] == $row['capacity']){
          $check_student = "SELECT studentid FROM registired_students WHERE 
            studentid='$second_studentid' AND courseid='$required_courseid'";
          $result_student = mysqli_query($conn,$check_student);
          if($result_student->num_rows>0){
            $accept_value = 0;
            $send_request = "INSERT INTO course_change(first_studentid, second_studentid, 
            current_courseid, required_courseid, accept)
            VALUES('$first_studentid','$second_studentid', '$current_courseid', '$required_courseid' , '$accept_value')";
            $request_result = mysqli_query($conn, $send_request);
            if($request_result){
              echo "<script>alert('Course change request has sent!')</script>";
            }
          }else{
            echo "<script>alert('Other student has not registired to the required course! You cannot send a course change request to $second_studentid ')</script>";
          }
        }else{
          echo "<script>alert('Course capacity is not FULL! You can register without send a course change request')</script>";
        }
      }
    }
  }

  }



?>


        