<?php 

session_start();
require_once('../config.php');

deleteData('purchases',$_REQUEST['id']);
header('location:'.GET_APP_URL().'/purchase?success=Delete Successfully..');

?>