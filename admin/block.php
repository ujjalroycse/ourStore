<?php 

session_start();
require_once('../config.php');

$userId = $_REQUEST['id'];

$stm = $connection->prepare("UPDATE users SET status=? WHERE id=?");
$stm->execute(array('Blocked',$userId));

header('location:'.GET_APP_URL().'/admin/all-users.php?success=Blocked Successfully..');

?>