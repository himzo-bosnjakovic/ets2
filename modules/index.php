<meta charset="utf-8"></meta>
<?php
	session_start();
	if ( ! defined( "ETSTuzla" ) )
	{
		define( "ETSTuzla", true );
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "settings/mysql_conn.php";
?>

<html>
	<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "modules/head.php"; ?>
	<body>
		<!-- Meni -->
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "modules/menu.php"; ?>
		
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "modules/logged-navigation.php"; ?>
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "modules/navigation.php"; ?>

		<!-- Wrapper -->
		<div id="wrapper">
                
			<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "modules/header.php"; ?>
            
			<!-- Main area -->
			<div id="main">
				<?php
					if (isset($_GET["action"]))
					{
						switch ($_GET["action"])
						{
							case "new":
								require_once "actions/new.php";
								break;
							case "login":
								require_once "actions/login.php";
								break;
							case "register":
								require_once "actions/register.php";
								break;
							case "logout":
								require_once "actions/logout.php";
								break;
							case "reset":
								require_once "actions/reset.php";
								break;
							default:
								echo "<center><b style='font-size: 36px;'>Akcija ne postoji!</b></center>";
						}
					}
					else
					{
						$query = "SELECT * FROM `$table_news` ORDER BY `ID` DESC LIMIT 5";
						$result = mysqli_query($conn, $query);
						if(!$result) die("Mysql sintaksna pogreška[index.php - 1]: " . mysqli_error($conn));
						if(!mysqli_num_rows($result)) // Provjeravamo da li je query vratio neke rezultate
						{
							echo "<div id='nonews'>Nemamo novosti da vam prikažemo :(</div>";
						}
						
							while($data = mysqli_fetch_assoc($result)) // ovo je petlja koja ce da se odradjuje dokle god ima rezultata
							{
								echo "<div class='news'>";
								echo $data["Content"];
								echo "<span class='autor'>Autor: " . $data["Autor"];
								
								$query = "SELECT `Group` FROM `$table_users` WHERE `Username` = '" . $data["Autor"] . "'";
								$result1 = mysqli_query($conn, $query);
								if(!$result1) die("Mysql sintaksna pogreška[index.php - 2]: " . mysqli_error($conn));
								$data = mysqli_fetch_assoc($result1);
								echo " [" . $data["Group"] . "]";
								
								echo "</span></div></br><hr>";
							}
						
					}
				?>
            </div>
				
		</div>
		
		<!-- Footer -->
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "modules/footer.php"; ?>
	</body>
</html>