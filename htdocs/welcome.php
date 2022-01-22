<?php
session_start();
if($_SESSION['auth']!=1){
 session_destroy(); 
header("Location:redirect.php");

}

  if(isset($_POST['submit'])){
    session_start();
    session_destroy();
    
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>🌀Courser-master</title>
    <link rel="stylesheet" href="style/coursesst.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div id="nav-bar">
        <ul id="nav-ul">
          <li class="left-side"><a href="welcome.php">🌀 Courser-Master</a></li>
          <li class="right-side"><a href="logout.php">➡️Log Out</a></li>
          <li class="right-side"><a href="account.php">🔑Account</a></li>
          <li class="right-side"><a href="registiration.php">➕Register Courses</a></li>
          <li class="right-side"><a href="mycourses.php">📘My Courses</a></li>
        </ul>
      </div>
      <div class="typewriter">
    <h1>LEARN MORE SKILLS, BE MORE COMPETETIVE...</h1>
      <div id="content">
        <button id="regbtn"><a href="registiration.php">For more information</a></button>
        

</div>
    </div>
    
  </body>
</html>
