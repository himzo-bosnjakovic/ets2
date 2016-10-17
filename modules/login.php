<meta charset="utf-8"></meta>
<?php
	//session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . "/ETS2/" . "settings/hacker_check.php";
?>

<div id="login">
   <form id='login' action='login.php' method='post' accept-charset='UTF-8'>
<fieldset >

<input type='hidden' name='submitted' id='submitted' value='1'/>
 
<label for='username' >Username:</label>
<input type='text' name='username' id='loginput'  maxlength="50" />
 
<label for='password' >Password:</label>
<input type='password' name='password' id='loginput' maxlength="50" />
 
<input type='submit' name='Submit' value='Submit' />
 
</fieldset>
</form>
</div>