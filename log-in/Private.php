<?php

session_start();
if(!isset($_SESSION['username'])){
	header("Location: http://www.login.oscarbjorkman.com");
	exit;
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Oscar Bjorkman</title>
</head>

<body>

Private page

<a href="logout.php">Logout</a>

</body>
</html>