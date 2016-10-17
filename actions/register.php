<meta charset="utf-8"></meta>
<?php
	//session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "settings/hacker_check.php";
	
	if (isset($_COOKIE["LoggedIn"])) die ("<center><div style='font-size: 36px;'>Već imaš account</div></center>");
?>

<center>
	<form name="Register" method="POST" action="">
		<input name="Username" type="text" placeholder="Username" required autofocus><br>
		<input name="Password" type="password" placeholder="Password" required><br>
		<input name="E-mail" type="email" placeholder="E-mail" required><br>
		<input name="Submit" type="submit" value="Registruj se"><br>
	</form>
	<?php
		if(isset($_POST["Submit"]))
		{
			$username = $_POST["Username"];
			$password = $_POST["Password"];
			$email = $_POST["E-mail"];
			$username_safe = mysqli_real_escape_string($conn, $username);
			$password_hash = hash("whirlpool", $password);
			$email_safe = mysqli_real_escape_string($conn, $email);
			
			$query = "SELECT 1 FROM `$table_users` WHERE `Username` = '$username_safe'";
			$result = mysqli_query($conn, $query);
			if(!$result) die("Mysql sintaksna pogreška[index.php - 1]: ".mysqli_error($conn));
			if (mysqli_num_rows($result)) die ("Ime je zauzeto!");
			
			$query = "SELECT 1 FROM `$table_users` WHERE `E-mail` = '$email_safe'";
			$result = mysqli_query($conn, $query);
			if(!$result) die("Mysql sintaksna pogreška[index.php - 1]: ".mysqli_error($conn));
			if (mysqli_num_rows($result)) die ("Email je zauzet!");
			
			$query = "INSERT INTO `$table_users` (`Username`, `Password`, `E-mail`) VALUES ('$username_safe', '$password_hash', '$email_safe')";
			$result = mysqli_query($conn, $query);
			if(!$result) die("Mysql sintaksna pogreška[index.php - 1]: ".mysqli_error($conn));
			echo "<span>";
			echo "Uspješno ste se registrovali!";
			echo "</span>";
		}
	?>
</center>