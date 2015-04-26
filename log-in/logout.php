<?php

session_start();
unset($_SESSION);
session_destroy();
session_write_close();

header('Location: http://www.login.oscarbjorkman.com');
exit;

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>