<?php 

session_start();
require_once('../config.php');

deleteData('groups',$_REQUEST['id']);
header('location:'.GET_APP_URL().'/groups?success=Delete Successfully!');


?>