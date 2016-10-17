<?php
	if ( ! defined( 'MySQL' ) )
	{
		define( 'MySQL', true );
	}
	require_once $_SERVER['DOCUMENT_ROOT'] . '/ETS2/' . 'settings/mysql_conn.php';
	
	if ( ! defined( 'ETSTuzla' ) )
	{
		define( 'ETSTuzla', true );
	}
?>

<html>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/ETS2/' . 'modules/head.html'; ?>
	<body>
		<!-- Meni -->
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/ETS2/' . 'modules/menu.html'; ?>
	
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/ETS2/' . 'modules/navigation.html'; ?>

		<!-- Wrapper -->
		<div id='wrapper'>
                
			<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/ETS2/' . 'modules/header.html'; ?>
            
			<!-- Main area -->
			<div id='main'>
				<?php
					if (isset($_GET['action']))
					{
						switch ($_GET['action'])
						{
							case 'new':
								require_once 'actions/new.php';
								break;
							default: echo "<center><b style='font-size: 36px;'>Akcija ne postoji!</b></center>";
						}
					}
					else
					{
						$query = "SELECT * FROM `$table_news` ORDER BY `ID` DESC LIMIT 5";
						$result = mysqli_query($conn, $query);
						if(!$result) die("Mysql sintaksna pogreška[index.php - 1]: ".mysqli_error($conn));
						if(!mysqli_num_rows($result)) // Provjeravamo da li je query vratio neke rezultate
						{
							echo "<div id='nonews'>Nemamo novosti da vam prikažemo :(</div>";
						}
						
						while($data = mysqli_fetch_assoc($result)) // ovo je petlja koja ce da se odradjuje dokle god ima rezultata
						{
							echo "<div class='news'>";
							echo $data["Content"];
							echo "<span class='autor'>Autor: " . $data["Autor"] . "</span>";
							echo "</div></br>";
						}
					}
				?>
            </div>
				
		</div>
		
		<!-- Footer -->
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/ETS2/' . 'modules/footer.html'; ?>
	</body>
</html>