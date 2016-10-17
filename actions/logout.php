<meta charset="utf-8"></meta>
<?php
	//session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "settings/hacker_check.php";
	
	if (!isset($_COOKIE["LoggedIn"])) die ("<center><div style='font-size: 36px;'>Ljudino nisi ni prijavljen</div></center>");
	
	setcookie("LoggedIn", 	true, 				time() - 3600, "/");
	setcookie("Username", 	$data["Username"], 	time() - 3600, "/");
	setcookie("Group", 		$data["Group"], 	time() - 3600, "/");
	
	header("Location: index.php");
?>