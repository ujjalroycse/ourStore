<?php 

function InputCount($col,$value){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM users WHERE $col=?");
  $statement->execute(array($value));
  $count = $statement->rowcount();

  return $count;
}
function getProfile($id){
  global $connection;
  $statement = $connection->prepare("SELECT * FROM users WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result;
}

function get_header(){
  require_once('includes/header.php');
}
function get_footer(){
  require_once('includes/footer.php');
}

?>