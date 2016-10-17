<meta charset="utf-8"></meta>
<?php
	//session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "settings/hacker_check.php";
	
	if (isset($_COOKIE["LoggedIn"])) die ("<center><div style='font-size: 36px;'>Već si prijavljen ljudino</div></center>");
?>

<center>
	<form name="Login" method="POST" action="">
		<input name="Username" type="text" placeholder="Username" required  autofocus><br>
		<input name="Password" type="password" placeholder="Password" required><br>
		<input name="Submit" type="submit" value="Login"><br>
	</form>
	<?php
		if(isset($_POST["Submit"]))
		{
			$username = $_POST["Username"];
			$password = $_POST["Password"];
			$username_safe = mysqli_real_escape_string($conn, $username);
			$password_hash = hash("whirlpool", $password);
			$query = "SELECT * FROM `$table_users` WHERE `Username` = '$username_safe' AND `Password` = '$password_hash' LIMIT 1";
			$result = mysqli_query($conn, $query);
			if(!$result) die("Mysql sintaksna pogreška[login.php - 1]: " . mysqli_error($conn));
			if(!mysqli_num_rows($result)) // Provjeravamo da li je query vratio neke rezultate
			{
				echo "<div>Username ili password nisu tačni! <br> <a href='?action=register'>Registrujte se</a> ili <a href='?action=reset'>resetujte šifru</a>! :(</div>";
			}
			else
			{
				$data = mysqli_fetch_assoc($result);
				setcookie("LoggedIn", 	true, 				time() + (86400 * 30), "/");
				setcookie("Username", 	$data["Username"], 	time() + (86400 * 30), "/");
				setcookie("Group", 		$data["Group"], 	time() + (86400 * 30), "/");
				echo "<script>";
					echo "alert('Ulogovani ste na 30 dana, $username_safe');";
					echo "window.location.replace('index.php');";
				echo "</script>";
				//header("Location: index.php");
			}
		}
	?>
</center>