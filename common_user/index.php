<?php
include "../db.php";
session_start();
$s_user_id = $_SESSION['user_info_id'];
if($_SESSION['user_info_user_type'] != 'C'){
    header("location: ../index.php");
}
if(isset($_GET['logout'])){
    session_destroy();
    header("location: ../index.php"); //go back to landing page of visitors page.
    die();
}

if(isset($_GET['delete_from_cart'])){
    $order_id = $_GET['delete_from_cart'];
    $sql_delete_from_cart = "DELETE FROM orders WHERE orders_id = '$order_id' and order_phase = '1' ";
    $sql_execute = mysqli_query($conn, $sql_delete_from_cart);
    if($sql_execute){
        header("location: index.php?msg=cart_item_removed");
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    
    <div class="container-fluid">
       <div class="row">
           <div class="col-12">
                 <h3 class="display-3">
                    Welcome <?php echo $_SESSION['user_info_fullname']; ?>
                    
                </h3>
                <a href="?page=home" class="btn btn-link">Home</a>
                <a href="?page=myorder" class="btn btn-link">My Orders</a>
                <a href="?logout" class="btn btn-link">Logout</a>
               
           </div>
       </div>
    <?php if(isset($_GET['page'])){
                if($_GET['page'] == 'home'){ ?>
<!--                       Load the Home Content-->
                        <div class="row"> 
                            <div class="col-9">

                                <div class="container-fluid">
                                       <div class="row">
                                        <?php

                               $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' order by items_id DESC";
                               $get_result = mysqli_query($conn, $sql_get_items); ?>

                                   <?php
                                       while ( $row = mysqli_fetch_assoc($get_result) ){ ?>

                                           <div class="col-3 p-0">
                                                   <div class="card">
                                                       <img src="../img/<?php echo $row['item_img'];?>" width="100px" class="card-img">
                                                       <div class="card-body">
                                                           <h3 class="card-title">
                                                               <?php echo $row['item_name'];?>
                                                           </h3>
                                                           <p class="card-text"><?php echo $row['item_desc'];?></p>
                                                             <blockquote class="blockquote mb-0">
                                                                  <p><?php echo "Php " . number_format($row['item_price'],2);?></p>
                                                                </blockquote>

                                                       </div>
                                                   </div>

                                                <form action="process_add_to_cart.php" method="get">
                                                  <div class="input-group">
                                                   <input type="text" hidden class="form-control" name="item_id" value="<?php echo $row['items_id'];?>">
                                                   <input type="number" min="1" value="1" class="form-control" placeholder=1 name="cart_qty">
                                                    <input type="submit" value="Add to Cart" class="btn btn-primary">
                                                </div>
                                                </form>
                                            </div> 


                                       <?php }
                                   ?>
                                   </div>
                                </div>
                            </div>
                            <div class="col-3">
                <!--              Cart-->
                               <?php
                                if(isset($_GET['checkout'])){ ?>

                                    <div class="card p-1">
                                        <h3 class="card-title">Checkout Summary</h3>

                                        <div class="card-body">
                                            <?php
                                    //generate order reference number
                                                $order_number=gen_order_ref_number(8);

                                                $sql_checkout="SELECT i.item_name
                                                                , i.item_price
                                                                , i.item_desc
                                                                , i.item_img
                                                                , o.item_qty
                                                                , o.date_added
                                                                , o.orders_id
                                                             FROM `orders` as o
                                                             JOIN `items` as i
                                                               ON (o.item_id = i.items_id)
                                                            WHERE o.user_id='$s_user_id' 
                                                              AND o.order_phase='1'";
                                            $result_chkout = mysqli_query($conn,$sql_checkout);
                                            ?>
                                            <div class="alert alert-light">
                                                Order Reference Number: <?php echo $order_number; ?>
                                                <br>
                                                Receiver: <?php echo  $_SESSION['user_info_fullname'] ; ?>
                                                <br>
                                                Address: <?php echo $_SESSION['user_info_address']; ?>
                                            </div>

                                            <ul class="list-group">
                                                <?php
                                            //initialize total amount
                                            $total_amt = 0.00;
                                                while ($co = mysqli_fetch_assoc($result_chkout)){
                                                //adds up every loop of the result.
                                                $total_amt = $total_amt + $co['item_price'] * $co['item_qty'];
                                                ?>

                                                    <li class="list-group-item"><?php echo $co['item_name'] . " - Php " . number_format($co['item_price'],2) . " x " . $co['item_qty'] . " pcs";?></li>
                                                <?php 
                                                }
                                                ?>
                                                <li class="list-group-item">
                                                   <b> Total Amount to Pay: <?php echo "Php " . number_format($total_amt,2);?> </b>
                                                </li>
                                            </ul>

                                            <form action="process_place_order.php" method="post">
                                                <div class="mt-3">

                                            <label for="" class="form-label">Payment Method:</label> 
                                                    <select name="f_payment_method" id="" class="form-select mb-3">
                                                        <?php  
                                                        $sql_get_payment_method = "SELECT * FROM `payment_method`";
                                                        $payment_method_result = mysqli_query($conn, $sql_get_payment_method);;

                                                        while($pm = mysqli_fetch_assoc($payment_method_result)){ ?>
                                                            <option value="<?php echo $pm['payment_method_id'];?>"><?php echo $pm['payment_method_desc'];?></option>
                                                        <?php }
                                                        ?>

                                                    </select>
                                                    <input hidden type="text" name="f_order_ref_number" value="<?php echo $order_number; ?>">

                                                    <input type="submit" value="Place Order" class="btn btn-warning">
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                <?php } ?>

                               <?php
                                if(isset($_GET['msg'])){
                                     $msg = $_GET['msg']; 
                                     $status = "";
                                        if($msg == 1){
                                            $status = "Order Placed Successfully.";
                                            ?>
                                            <div class="alert alert-success">
                                                <?php echo $status;?>
                                            </div>
                                <?php   }  
                                        else{
                                            $status = "Order Failed.";
                                            ?>
                                            <div class="alert alert-danger">
                                                 <?php echo $status;?>
                                            </div>
                                            <?php
                                        }

                                }
                                ?>
                                 <h6 class="display-6">Cart</h6>
                                <?php
                                    $sql_get_cart_items = "SELECT i.item_name
                                                                , i.item_price
                                                                , i.item_desc
                                                                , i.item_img
                                                                , o.item_qty
                                                                , o.date_added
                                                                , o.orders_id
                                                             FROM `orders` as o
                                                             JOIN `items` as i
                                                               ON (o.item_id = i.items_id)
                                                            WHERE o.user_id='$s_user_id' 
                                                              AND o.order_phase='1'";

                                    $cart_results = mysqli_query($conn, $sql_get_cart_items);
                                echo "<table class='table'>";
                                    while($cart = mysqli_fetch_assoc($cart_results)){ ?>
                                           <tr>
                                               <td> <img src="../img/<?php echo $cart['item_img']; ?>" alt="" class="img-fluid"> </td>
                                               <td> <?php echo $cart['item_name'];?> </td>
                                               <td> <?php echo $cart['item_qty'] . " pcs";?> </td>
                                               <td> <?php echo "Php " . number_format($cart['item_price'] * $cart['item_qty'],2); ?> </td>
                                               <td> <a href="?delete_from_cart=<?php echo $cart['orders_id'];?>" class="btn btn-danger btn-sm">x</a> </td>
                                           </tr>
                                    <?php }
                                echo "</table>";
                                ?>
                                <hr>
                               <a href="?page=home&checkout" class="btn btn-warning">Checkout</a>

                            </div>
                        </div>
                <?php }
                else if($_GET['page'] == 'myorder'){ ?>
                    <div class="row">
                    
                    <?php
                        $sql_get_user_order = "SELECT DISTINCT 
                                                  o.order_ref_number
                                                , pm.payment_method_desc
                                                , op.order_phase_desc
                                             FROM `orders` as o
                                             JOIN `payment_method` as pm
                                               ON o.payment_method = pm.payment_method_id
                                             JOIN `order_phase` as op
                                               ON o.order_phase = op.order_phase_id
                                            WHERE o.user_id = '$s_user_id' ";                            
                                                    
//                        $sql_get_user_item_order = "SELECT o.order_ref_number
//                                                , pm.payment_method_desc
//                                                , i.item_name
//                                                , i.item_img
//                                                , i.item_price
//                                             FROM `orders` as o
//                                             JOIN `items` as i
//                                               ON o.item_id = i.items_id
//                                             JOIN `payment_method` as pm
//                                               ON o.payment_method = pm.payment_method_id
//                                            WHERE o.user_id = '$s_user_id' ";
//                    
                    $result_orders = mysqli_query($conn, $sql_get_user_order);
                    
                    
                    while($rec = mysqli_fetch_assoc($result_orders)){ //first loop with only the order_reference_number ?>
                     <div class="col-3">
                         <div class="card mt-3">
                             <h6 class="card-title mt-1 ms-1"><?php 
                                                        echo $rec['order_ref_number'];
                                                        $curr_order_ref_number = $rec['order_ref_number'];
                                                    ?>
                                                    <div class="float-end">
                                                    <span class="badge rounded-pill text-bg-success"><?php echo $rec['payment_method_desc'];?></span>
                                                    <span class="badge rounded-pill text-bg-primary"><?php echo $rec['order_phase_desc'];?></span>
                                                    </div>
                            </h6>
                                        <?php
                                               $sql_get_user_item_order = "SELECT 
                                                                           i.item_name
                                                                         , i.item_img
                                                                         , i.item_price
                                                                         , o.item_qty
                                                                      FROM `orders` as o
                                                                      JOIN `items` as i
                                                                        ON o.item_id = i.items_id
                                                                     WHERE o.user_id = '$s_user_id' 
                                                                         AND o.order_ref_number = '$curr_order_ref_number'";
                                              $result_item_orders=mysqli_query($conn, $sql_get_user_item_order); ?>
                                                <div class="list-group">
                                               <?php $total_amt = 0.00;
                                                    while($io = mysqli_fetch_assoc($result_item_orders)){ 
                                                    $total_amt = $total_amt + ($io['item_qty'] * $io['item_price']);
                                                    ?>
                                                   <li class="list-group-item">
                                                              <img src="../img/<?php echo $io['item_img'];?>" width="40px" alt="" class="img-fluid">
                                                               <?php echo $io['item_name'] . " x ";?>
                                                               <?php echo $io['item_qty'] . " pcs <br>";?>
                                                              <small class="small float-end"> <?php echo "Php " . number_format($io['item_price'],2);?></small>
                                                  </li>
                                               <?php } ?>
                                               
                                               
                                                </div>
                                                <div class="card-footer">
                                                    <span class="float-end"> Total Amount: <b> <?php echo "Php " . number_format($total_amt,2); ?> </b> </span> 
                                                </div>
                             
                         </div>
                     </div>
                    <?php }
                    ?>
<!--                    load the My Order Page-->
                    </div>
                <?php }
        
    }
  
    ?>
      
    </div>
    
</body>
   <script src="../js/bootstrap.js"></script>
</html>