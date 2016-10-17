<meta charset="utf-8"></meta>
<?php
	if ( ! defined( 'MySQL' ) )
	{
		die ("<center><h1>Ne može care :)</h1></center>");
	}

	$host = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = mysqli_connect($host, $username, $password);

	// Check connection
	if (!$conn) die("Connection failed: " . mysqli_connect_error());
	
	////////////////////////////////////////////////////////////////
	
	$database_name = "ETS";
	$table_groups = "Groups";
	$table_users = "Users";
	$table_news = "News";
	
	// Pravi BAZU ako ne postoji
	$query = "CREATE DATABASE IF NOT EXISTS `$database_name`";
	$result = mysqli_query($conn, $query);
	if(!$result) die("Mysql sintaksna pogreška[1]: ".mysqli_error($conn));
	if(!mysqli_select_db($conn, $database_name)) die("Nemoguce povezivanje na databazu: ".mysqli_error($conn));
	
	// Pravi tabelu za GRUPE KORISNIKA ako ne postoji
	$query = "CREATE TABLE IF NOT EXISTS `$table_groups`
	(
	`ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`Name` varchar(50) NOT NULL
	)";
	$result = mysqli_query($conn, $query);
	if(!$result) die("Mysql sintaksna pogreška[2]: ".mysqli_error($conn));
	
	// Pravi tabelu za KORISNIKE ako ne postoji
	$query = "CREATE TABLE IF NOT EXISTS `$table_users`
	(
	`ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`Username` varchar(50) NOT NULL,
	`Password` varchar(129) NOT NULL,
	`Group` varchar(50) NOT NULL
	)";
	// treba dodat foreign key za Group na Groups.Name
	$result = mysqli_query($conn, $query);
	if(!$result) die("Mysql sintaksna pogreška[3]: ".mysqli_error($conn));
	
	// Pravi tabelu za NOVOSTI/VIJESTI ako ne postoji
	$query = "CREATE TABLE IF NOT EXISTS `$table_news`
	(
	`ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`Content` LONGTEXT CHARACTER SET utf8 NOT NULL,
	`Posted` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
	`Autor` varchar(50) NOT NULL
	)";
	// treba dodat foreign key za Autor na Users.Username
	$result = mysqli_query($conn, $query);
	if(!$result) die("Mysql sintaksna pogreška[4]: ".mysqli_error($conn));
?> 