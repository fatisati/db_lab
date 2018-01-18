<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyTickets</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <div  class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href='login.html'>Logout</a></li>
            <li><a href="buyticket.html">BuyTicket</a></li>
            <li><a href="mytickets.html">MyTickets</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="buykadr">
				<?php
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
				?>

                <a href="buyticket.html">buy more!</a>
            </div>
        </div>
        <div class="col-md-4"></div>

    </div>

</div>
</body>

</html>