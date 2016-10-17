<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "settings/hacker_check.php";

	$host = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = mysqli_connect($host, $username, $password);

	// Check connection
	if (!$conn) die("Connection failed: " . mysqli_connect_error());
	
	////////////////////////////////////////////////////////////////
	
	$database_name = "ETS";
	$table_users = "Users";
	$table_news = "News";
	
	// Pravi BAZU ako ne postoji
	$query = "CREATE DATABASE IF NOT EXISTS `$database_name`";
	$result = mysqli_query($conn, $query);
	if(!$result) die("Mysql sintaksna pogreška[1]: ".mysqli_error($conn));
	if(!mysqli_select_db($conn, $database_name)) die("Nemoguce povezivanje na databazu: ".mysqli_error($conn));
	
	// Pravi tabelu za KORISNIKE ako ne postoji
	$query = "CREATE TABLE IF NOT EXISTS `$table_users`
	(
	`ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`Username` varchar(50) NOT NULL UNIQUE,
	`Password` varchar(129) NOT NULL,
	`E-mail` varchar(80) NOT NULL UNIQUE,
	`Group` varchar(50) NOT NULL default 'Admin',
	`Registered` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP
	)";
	$result = mysqli_query($conn, $query);
	if(!$result) die("Mysql sintaksna pogreška[2]: ".mysqli_error($conn));
	
	// Pravi tabelu za NOVOSTI/VIJESTI ako ne postoji
	$query = "CREATE TABLE IF NOT EXISTS `$table_news`
	(
	`ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`Content` LONGTEXT CHARACTER SET utf8 NOT NULL,
	`Posted` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
	`Autor` varchar(50) NOT NULL
	)";
	$result = mysqli_query($conn, $query);
	if(!$result) die("Mysql sintaksna pogreška[3]: ".mysqli_error($conn));
	
	// Dodaje foreign key Users.Username na Autor ako ne postoji
	$query = "ALTER TABLE `$table_news` ADD CONSTRAINT `FK_Users_Autor` FOREIGN KEY (Autor) REFERENCES `$table_users`(Username) ON UPDATE CASCADE ON DELETE SET NULL";
	mysqli_query($conn, $query);
?> 