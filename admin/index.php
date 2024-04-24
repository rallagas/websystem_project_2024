<?php 

//welcome admin

session_start();
if($_SESSION['user_info_user_type'] != 'A'){
    header("location: ../index.php");
}


?>