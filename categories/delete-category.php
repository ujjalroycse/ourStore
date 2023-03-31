<?php 

session_start();
require_once('../config.php');

deleteData('categories',$_REQUEST['id']);
header('location:'.GET_APP_URL().'/categories?success=Delete Successfully..');

?>