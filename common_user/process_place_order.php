<?php
include_once "../db.php";
session_start();

if(isset($_POST['f_payment_method'])){
    $payment_method = $_POST['f_payment_method'];
    $order_ref_number = $_POST['f_order_ref_number'];
    $user_id = $_SESSION['user_info_id'];
        
    $sql_update_order = "UPDATE `orders`
                            SET `order_phase` = 2
                              , `payment_method` = '$payment_method'
                              , `order_ref_number` = '$order_ref_number'
                          WHERE `user_id` = '$user_id' 
                            AND `order_phase` = '1'
                          ";
    $execute_update_order = mysqli_query($conn, $sql_update_order);
    
    if($execute_update_order == 1){
        header("location: index.php?page=home&msg=1");
    }
    else{
        header("location: index.php?page=home&msg=2");
    }

}


