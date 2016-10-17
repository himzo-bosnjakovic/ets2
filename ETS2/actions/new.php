<meta charset="utf-8"></meta>
<?php
	if ( ! defined( 'ETSTuzla' ) )
	{
		die ("<center><h1>Ne može care :)</h1></center>");
	}
?>
<center>
	<form name='Nova_Vijest' method='POST' action='<?php echo htmlentities($_SERVER['PHP_SELF'] . '?action=new'); ?>'>
		<input name='content' type='text'><br>
		<input name='autor' type='text'><br>
		<input name='submit' type='submit' value='Postavi vijest'><br>
	</form>
	<?php
		if(isset($_POST['submit']))
		{
			$content = $_POST['content'];
			$autor = $_POST['autor'];
			$content_safe = mysqli_real_escape_string($conn, $content);
			$autor_safe = mysqli_real_escape_string($conn, $autor);
			$query = "INSERT INTO `$table_news` (`Content`, `Autor`) VALUES ('$content_safe', '$autor_safe')";
			$result = mysqli_query($conn, $query);
			if(!$result) die("Mysql sintaksna pogreška[index.php - 1]: ".mysqli_error($conn));
			echo "<span id='news_added'>";
			echo "Uspjesno ste dodali novost: <br> Content: $content <br> Content_Safe: $content_safe";
			echo "</span>";
		}
	?>
</center>