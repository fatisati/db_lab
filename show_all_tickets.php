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