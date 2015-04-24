<?php 

$link = mysql_connect('oscarbjorkmancom.ipagemysql.com', 'objorkman', 'Lovelego123');  // Connection to database


if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
// echo 'Connected successfully'; 
mysql_select_db(login_database_1); 

if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
}
if (isset($_POST['user'])) {
       
	$username = $_POST['user'];
	$password = $_POST['pass'];
	// Query to check to see if the username and password supplied match the database records
	$sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1";
	$res = mysql_query($sql);
	// If login information is correct
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeqQQMTAAAAAK-22_DFqSa31umVwPzInB5C5M7p&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    
    if($response.success == false) {
        echo "False";
        exit();
    }
    
	if (mysql_num_rows($res) == 1) {
        if ($response.success == true) {
            echo "You have successfully logged in.";
            exit();
        }
        else {
            echo "Do the recaptcha";
        }
	}
    else if ($response.success == true) {
        echo "Please enter your credentials"
        exit();
    }
	// If login information is invalid
	else {
		echo "Invalid credentials.";
		exit();
	}
}

?> 