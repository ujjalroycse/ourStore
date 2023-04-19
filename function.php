<?php 

function InputCount($col,$value){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM users WHERE $col=?");
  $statement->execute(array($value));
  $count = $statement->rowcount();

  return $count;
}

function InputAdminCount($col,$value){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM admins WHERE $col=?");
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

//Get admin data
function getAdminData($table){
  global $connection;
  $statement = $connection->prepare("SELECT * FROM $table");
  $statement->execute(array());
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

//Get single table data
function getUserSingleData($table,$id){
  global $connection;
  $statement = $connection->prepare("SELECT * FROM $table WHERE id=?");
  $statement->execute(array($id));
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


function adminProfile($id){
  global $connection;
  $statement = $connection->prepare("SELECT * FROM admins WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result;
}

// get profile data
function getAdminProfile($id){
  global $connection;
  $statement = $connection->prepare("SELECT * FROM admins WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result;
}

// get product category data
function getProductCategoryName($col,$id){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM categories WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result[$col];
}

// // get table data
function getPurchasesData($table,$col,$id){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM $table WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result[$col];
}

// Get group data
function getGroupData($col,$name,$id){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM groups WHERE group_name=? AND product_id=?");
  $statement->execute(array($name,$id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result[$col];
}

// Get sake data
function getSaleData($col,$name,$id){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM sales WHERE group_name=? AND product_id=?");
  $statement->execute(array($name,$id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result[$col];
}

function getGroupDataById($col,$id,$pid){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM groups WHERE id=? AND product_id=?");
  $statement->execute(array($id,$pid));
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  return $result[$col];
}

// get purchases data
function getManufactureName($col,$id){
  global $connection;
  $statement = $connection->prepare("SELECT $col FROM manufacture WHERE id=?");
  $statement->execute(array($id));
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  return $result[$col];
}

//get Total Data
function getTotalData($table,$col){
  $total_data = 0;
  $allDatas = getTableData($table);
  foreach($allDatas as $allData){
    $total_data = $total_data + $allData[$col];
  }
  return $total_data;
}

//get Total Data
function getTotalProducts($table){
  global $connection;
  $statement= $connection->prepare("SELECT id FROM $table");
  $statement->execute();
  $result = $statement->rowCount();

  return $result;
}


function get_header(){
  require_once('includes/header.php');
}
function get_footer(){
  require_once('includes/footer.php');
}
function admin_header(){
  require_once('admin/header.php');
}
function admin_footer(){
  require_once('admin/footer.php');
}

?>