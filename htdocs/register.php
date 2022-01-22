
<?php 

include 'C:\xampp\htdocs\config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
  header("Refresh:0");
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
              
	if ($password == $cpassword) {
		$sql = "SELECT * FROM login_verify_php WHERE email='$email' OR username='$username'" ;
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO login_verify_php (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('User Registration Completed.');
          window.location.href='index.php';
        </script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
        
        
        

			} else {
				echo "<script>alert('Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Email or Username Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="style/register.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
</head>
<body>
<video autoplay loop muted id="myVideo">
  
</video>
  <div class="login-area">
  <h1>SIGN UP</h1>
  <form  id="loginform" action="" method="POST">
    
    <input class="inputs"type="text" autocomplete="off" name="username" placeholder="Student ID" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    ><br>
    <input class="inputs"type="text" autocomplete="off" name="email" placeholder="Email" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')">
      <br>
    <input class="inputs"type="password" autocomplete="off" name="password" placeholder="Password" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    >
    <br>
    <input class="inputs"type="password" autocomplete="off" name="cpassword" placeholder="Confirm Password" required 
      oninvalid="this.setCustomValidity('Please fill the area!')" onchange="this.setCustomValidity('')"
    >
    <br><input class="inputs" id="loginbtn"type="submit" name="submit" id="loginbtn"value="Sign Up">

  </form>
</div>
</body>
</html>