<?php 

session_start();
require_once('../config.php');

deleteData('manufacture',$_REQUEST['id']);
header('location:'.GET_APP_URL().'/manufacture?success=Delete Successfully..');

?>