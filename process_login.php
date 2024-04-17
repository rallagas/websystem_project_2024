<?php
include_once "db.php";
if(isset($_POST['f_username'])){
    $uname = $_POST['f_username'];
    $pword = $_POST['f_password'];
    
    $sql_check_user_info = "SELECT user_info_id
                                 , user_type
                                 , user_status
                                 , fullname
                                 , address
                              FROM `user_info`
                            WHERE `username` = '$uname'
                              AND `password` = '$pword'
                            ";
    $sql_result = mysqli_query($conn,$sql_check_user_info);
    $count_result = mysqli_num_rows($sql_result);
    
    if($count_result == 1){
        //existing user
        $row = mysqli_fetch_assoc($sql_result);
        echo $row['user_type'];
        if($row['user_type'] == 'A'){
            //admin
            header("location: admin");
        }
        else if($row['user_type'] == 'C'){
            //common user
            header("location: common_user");
        }
        else{
            header("location: index.php?error=user_not_found");
        }
    }
    else{
        //username and password does not exist
        header("location: registration.php?error=user_not_exist");
    }
}

?>