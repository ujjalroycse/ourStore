<?php 

session_start();
require_once('../config.php');

deleteData('sales',$_REQUEST['id']);
header('location:'.GET_APP_URL().'/sales?success=Delete Successfully..');

?>