<?php 

session_start();

$link = mysql_connect('oscarbjorkmancom.ipagemysql.com', 'objorkman', 'Lovelego123');  // Connection to database
// $link = mysql_connect('localhost', 'root', 'lovelego');  

if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
// echo 'Connected successfully'; 
mysql_select_db('login_database_1'); 

if (isset($_POST['user'])) {
	
    if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
	}   
	$username = $_POST['user'];
	$password = $_POST['pass'];
	// Query to check to see if the username and password supplied match the database records
	$sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1";
	$res = mysql_query($sql);
	// If login information is correct
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeqQQMTAAAAAK-22_DFqSa31umVwPzInB5C5M7p&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
	
	$response = json_decode($response, true);
    
//    if($response.success == true) {
//        echo "False";
//        exit();
//    }
   
	if (mysql_num_rows($res) == 1) {
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		
        if ($response.success == true) {
  //          echo "You have successfully logged in.";
			header("Location: http://www.oscarbjorkman.com/login/Private.php");
        }
        else {
			echo "Do the recaptcha";
			exit();
        }
	}
 //   else if ($response["success"] == false) {
 //       echo "Please do the recaptcha";
 //       exit();
 //   }
 
	// If login information is invalid
	else {
		echo "Invalid credentials.";
		
		exit();
	}
}

?> 

<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Log-in</title>

  <link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'>

    <link rel="stylesheet" href="css/style.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>

  <div class="login-card">
    <h1>Log-in</h1><br>
  <form method="post" action="index.php">
    <input type="text" name="user" placeholder="Username">
    <input type="password" name="pass" placeholder="Password">
    <div class="g-recaptcha" data-sitekey="6LeqQQMTAAAAAP4ygyt_T80jUuulsR7qrxmOtTKq"></div>
    <br />
    <input type="submit" name="login" class="login login-submit" value="login">
  </form>


  <div class="login-help" style="visibility:hidden" id="warning">
    <a>Do the Recaptcha</a>
  </div>

</div>

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->

  <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>

</body>

</html>