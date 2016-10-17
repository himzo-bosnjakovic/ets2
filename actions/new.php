<meta charset="utf-8"></meta>
<?php
	//session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "settings/hacker_check.php";
	
	if (isset($_COOKIE["LoggedIn"]))
	{
		if (strcmp($_COOKIE["Group"], "Novinar") && strcmp($_COOKIE["Group"], "Administrator"))
			die ("<center><div style='font-size: 36px;'>Nemaš dozvolu za ovo!</div></center>");
	}
	else die ("<center><div style='font-size: 36px;'>Nisi prijavljen!</div></center>");
?>

<center>
	<form name="Nova_Vijest" method="POST" action="">
		<textarea name="Content" type="text" placeholder="Vijest u HTML obliku" required autofocus></textarea><br>
		<input name="Submit" type="submit" value="Postavi vijest"><br>
	</form>
	<?php
		if(isset($_POST["Submit"]))
		{
			$content = $_POST["Content"];
			$autor = $_COOKIE["Username"];
			$content_safe = mysqli_real_escape_string($conn, $content);
			$autor_safe = mysqli_real_escape_string($conn, $autor);
			$content_safe = $content_safe . "<br>";
			$query = "INSERT INTO `$table_news` (`Content`, `Autor`) VALUES ('$content_safe', '$autor_safe')";
			$result = mysqli_query($conn, $query);
			if(!$result) die("Mysql sintaksna pogreška[index.php - 1]: ".mysqli_error($conn));
			echo "<span id='news_added'>";
			echo "Uspjesno ste dodali novost:<br>$content";
			echo "</span>";
		}
	?>
</center>