<?php 

function InputCount($col,$value){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM users WHERE $col=?");
  $statement->execute(array($value));
  $count = $statement->rowcount();

  return $count;
}

//Get Column Count
function getColumnCount($table,$col,$value){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM $table WHERE $col=?");
  $statement->execute(array($value));
  $count = $statement->rowcount();

  return $count;
}

//Get table data
function getTableData($table){
  global $connection;
  $statement = $connection->prepare("SELECT * FROM $table WHERE user_id=?");
  $statement->execute(array($_SESSION['user']['id']));
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}

//Get delete data
function deleteData($table,$id){
  global $connection;
  $statement = $connection->prepare("DELETE FROM $table WHERE user_id=? AND id=?");
  $delete = $statement->execute(array($_SESSION['user']['id'],$id));

  return $delete;
}

//Get single table data
function getSingleData($table,$id){
  global $connection;
  $statement = $connection->prepare("SELECT * FROM $table WHERE user_id=? AND id=?");
  $statement->execute(array($_SESSION['user']['id'],$id));
  $update = $statement->fetch(PDO::FETCH_ASSOC);

  return $update;
}

// get profile data
function getProfile($id){
  global $connection;
  $statement = $connection->prepare("SELECT * FROM users WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result;
}

// get profile data
function getProductCategoryName($col,$id){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM categories WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result[$col];
}

// // get profile data
function getPurchasesData($table,$col,$id){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM $table WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result[$col];
}

function getGroupData($col,$name,$id){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM groups WHERE group_name=? AND product_id=?");
  $statement->execute(array($name,$id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result[$col];
}

// get purchases data
// function getProductName($col,$id){
//   global $connection;
//   $statement = $connection->prepare("SELECT $col FROM products WHERE id=?");
//   $statement->execute(array($id));
//   $result = $statement->fetch(PDO::FETCH_ASSOC);
//   return $result[$col];
// }


function get_header(){
  require_once('includes/header.php');
}
function get_footer(){
  require_once('includes/footer.php');
}

?>