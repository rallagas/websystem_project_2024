<?php
if(isset($_GET['f_item_name'])){ //trap
    include_once "db.php";
    
    $item_name = $_GET['f_item_name'];
    $item_desc = $_GET['f_item_desc'];
    $item_price = $_GET['f_item_price'];
    
    $sql_insert_item = "INSERT INTO `items`
                    (`item_name`, `item_desc`, `item_price`)
                      VALUES
                    ('$item_name','$item_desc','$item_price');";

    $execute_query=mysqli_query($conn, $sql_insert_item);
    
    if($execute_query){
        echo "Data inserted.";   
        header("location: index.php?insert_status=1");
    }
    
}
else{
    header("location: index.php?you_cant_be_here");
}