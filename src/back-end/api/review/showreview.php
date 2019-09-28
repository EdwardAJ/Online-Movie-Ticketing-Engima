<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allowed-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../database_connection.php';
$database = new Database();
$error = '';
$connection = $database->connect();

$uname = "nurdin";
$email= "muhnrdnhsn@gmail.com";
$telp = "+6285781234123";
$sql = "SELECT * FROM moviereview NATURAL JOIN movie NATURAL JOIN user WHERE username=".$uname." OR email=".$email." OR telp=".$telp;
$result = $connection->query($sql);

if($result->num_rows>0){
	while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
    
}else{
	echo "0 result";
}

$connection->close();
?>
