<?php include_once "__config.php"; ?>
<?php include "lib/common.lib" ?>
<html>
<head><title>Please Wait...</title>
<?php
	if (get("usr")=="") {go("login.php");}
	else {go("home.php");}
?>
</head>
<body></body>
</html>