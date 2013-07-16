<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "widget_cms");
	define("DB_PASS", "secretpassword");
	define("DB_NAME", "widget_corp");
	// 1. Create a DB connection
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	// Test if connection occured.
	if(mysqli_connect_errno()) {
		die("Database conncetion failed: " .
				mysqli_connect_error() .
				" (" . mysqli_connect_errno() . ")"
		);
	}
?>