<?php
session_start();
if($_SESSION['auth']!=1 && !isset($_SESSION['username'])){
  
header("Location:redirect.php");

}
include 'config.php';

if(isset($_POST['submit_password'])){
  $current_username = $_SESSION['username'];
  
  $current = $_POST['current'];
  $p1 = $_POST['p1'];
  $p2 = $_POST['p2'];
  if($p1!=$p2){
    echo "<script>alert('Passwords are not matched!')</script>";
  }
  else{
    $check = "SELECT password FROM login_verify_php WHERE username='$current_username' AND password='$current' ";
     $result = mysqli_query($conn,$check);
    if($result->num_rows>0){
      $change = "UPDATE login_verify_php SET password='$p1' WHERE username='$current_username'";
      mysqli_query($conn,$change);
      echo "<script>alert('Password is changed !')</script>";
    }else{
      echo "<script>alert('Current password is wrong!')</script>";
    }
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
    <link rel="stylesheet" href="style/account.css" />
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
      </div>
      <div id="content">
        
      <form id="pass_id"action="" method="post">
        <input class="inputs"type="password" name="current" placeholder="Current password" required
        oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
        <input class="inputs"type="password" name ="p1"placeholder="New password" required
        oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"> 
        <input class="inputs"type="password" name="p2" placeholder="Confirm New password"required
        oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
        <button id="regbtn"class="inputs"type="submit" name="submit_password">Change the password!</button>
        </form>
      </div>
      
    </div>
    
  </body>
</html>


