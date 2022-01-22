<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
  header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
  header("Refresh:0");
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM login_verify_php WHERE username='$username' AND password='$password'";
	$result = mysqli_query($conn, $sql);
  
	if ($result->num_rows > 0) {
		
		$_SESSION['username'] = $username;
    $_SESSION['auth']=1;
    $_SESSION['password'] = $password;
		header("Location: welcome.php");
	} else {
		echo "<script>alert('Email or Password is Wrong.')</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="style/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
</head>
<body>
<video autoplay loop muted id="myVideo">
  
</video>
  <div class="login-area">
   
  <h1>LOG IN</h1>
  <form id="loginform" action="" method="POST">
    
    <input class="inputs"type="text" autocomplete="off" name="username" placeholder="Student ID" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    ><br>
    <input class="inputs"type="password" autocomplete="off" name="password" placeholder="Password" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    >
    <br><input class="inputs" id="loginbtn"type="submit" name="submit" id="loginbtn"value="🔒Log In" >
    
  </form>
  <button class="inputs" id="regbtn"><a id="reg"href="register.php">Sign Up</a></button>
  
</div>
</body>
</html>
