<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_lab');
define('DB_USER','db_admin');
define('DB_PASSWORD','123456');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
/*
$ID = $_POST['user'];
$Password = $_POST['pass'];
*/
function SignIn()
{
session_start();   //starting the session for user profile page
echo $_POST['user'];
if(!empty($_POST['user']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
{
	$query = mysql_query("SELECT *  FROM users where username = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysql_error());
	$row = mysql_fetch_array($query) or die(mysql_error());
	if(!empty($row['userName']) AND !empty($row['pass']))
	{
		$_SESSION['userName'] = $row['pass'];
		echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";

	}
	else
	{
		echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
	}
}
}

function SignUp()
{
	
session_start();   //starting the session for user profile page//
	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
	$query = mysql_query("INSERT INTO users (username, passwords, name)
					VALUES ('$_POST[username]', '$_POST[password]', '$_POST[name]')") or die(mysql_error());
	
}



if(isset($_POST['submit']))
{
	SignIn();
}

if(isset($_POST['signup']))
{
	SignUp();	
}

?>


