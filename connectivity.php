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

if(!empty($_POST['user']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
{
	$query = mysql_query("SELECT *  FROM users where username = '$_POST[user]' AND passwords = '$_POST[pass]'") or die(mysql_error());
	$row = mysql_fetch_array($query) or die(mysql_error());
	if(!empty($row['username']) AND !empty($row['passwords']))
	{
		
		$_SESSION['username'] = $row['username'];
		

		echo file_get_contents("profile7.html");


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
function add_ticket()
{
	
	session_start();   //starting the session for user profile page//
	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
	$query = mysql_query("INSERT INTO ticket(gameDate, number, times, cost, info)
					VALUES ('$_POST[date]', '$_POST[number]', '$_POST[time]', '$_POST[cost]', '$_POST[info]')") or die(mysql_error());
	echo "inserted";
}


function reserveTickets () {

session_start();   
$con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD);

$sql = "SELECT * FROM db_lab.ticket where  ( id = '$_POST[id]' and number > 0 ) ";

$result = $con->query($sql) or die($con->error);

if ($result->num_rows > 0) {
    
	$sql2 = " INSERT INTO db_lab.reservedTicket (username,id)
				VALUES ('$_POST[username]','$_POST[id]')";
	$sql3 = "UPDATE db_lab.ticket SET number = number -1 where ( id = '$_POST[id]' ) ";			
	if ($con->query($sql2) === TRUE AND $con->query($sql3) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql2 . "<br>" . $con->error;
	}

}

else {
   echo "no ticket ";
}


$con->close();


}

function seerReservedTickets () {

session_start();
$servername = "localhost";
	$username = "db_admin";
	$password = "123456";
	$dbname = "db_lab";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	
	
	$sql = "SELECT * from reservedTicket where username = '$_POST[user]' ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "ticket id: " . $row["id"]. " - username: " . $row["username"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	$conn->close();
}

function show_all_tickets () {

	
	$servername = "localhost";
	$username = "db_admin";
	$password = "123456";
	$dbname = "db_lab";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * from ticket";
	

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "id: " . $row["id"]. " - info: " . $row["info"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	$conn->close();
}


if(isset($_POST['seeTicket']))
{
	seerReservedTickets ();	
}
if(isset($_POST['reserve']))
{
	reserveTickets ();	
}

if(isset($_POST['submit']))
{
	SignIn();
}
if(isset($_POST['signup']))
{
	SignUp();	
}
if(isset($_POST['add_ticket']))
{
	add_ticket();
}

if(isset($_POST['show_tickets']))
{
	
	show_all_tickets();
}
?>