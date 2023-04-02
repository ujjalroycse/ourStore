<?php 

session_start();
require_once('../config.php');

deleteData('products',$_REQUEST['id']);
header('location:'.GET_APP_URL().'/products?success=Delete Successfully..');

?>