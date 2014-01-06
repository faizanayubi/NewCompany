<?php require("constants.php"); ?>
<?php
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if(!$connection) {
		die("Could not connect to mysql :  ".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME, $connection);
	if(!$db_select) {
		die("Could not connect to database :  ".mysql_error());
	}
?>