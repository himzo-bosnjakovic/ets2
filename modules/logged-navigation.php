<meta charset="utf-8"></meta>
<?php
	//COOKIE_start();
	require_once ("settings/hacker_check.php");

	echo "<div class='logged-navigation'>";
		// Ako nije ulogovan, pokaži login i register buttone
		if (!isset($_COOKIE["LoggedIn"]) || $_COOKIE["LoggedIn"]!=true || !isset($_COOKIE["Group"]) || !isset($_COOKIE["Username"]))
		{
			require_once("login.php");
		}
		// Ako je ulogovan, pokaži mu opcije koje mu dozvoljava njegova grupa
		else
		{
			echo "<ul id='left-nav'>";
				if (isset($_COOKIE["Avatar"]))
					echo "<li id='avatar-nav'><img src='" . $_COOKIE["Avatar"] . "' /></li>";
			
				echo "<li id='message-nav'>Pozdrav " . $_COOKIE["Group"] . " " . $_COOKIE["Username"] . "</li>";
			echo "</ul>";
		
			echo "<ul id='right-nav'>";
				if ($_COOKIE["Group"]=="Administrator" || $_COOKIE["Group"]=="Novinar")
					echo "<li id='new-post'><a href='?action=new'>Postavi novu vijest</a></li>";
			
				echo "<li id='logout'><a href='?action=logout'>Logout</a></li>";
			echo "</ul>";
		}
	echo "</div>";
?>