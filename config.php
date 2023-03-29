<?php 

$servername = "localhost";
$database = "our_store";
$username = "root";
$password = "";

try {
  $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


require_once('function.php');

function APP_URL(){
  echo "http://localhost/ourStore";
}
function GET_APP_URL(){
  return "http://localhost/ourStore";
}


?>