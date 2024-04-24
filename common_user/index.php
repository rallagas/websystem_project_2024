<?php
include "../db.php";
session_start();
$s_user_id = $_SESSION['user_info_id'];
if($_SESSION['user_info_user_type'] != 'C'){
    header("location: ../index.php");
}
if(isset($_GET['logout'])){
    session_destroy();
    header("location: ../index.php");
    die();
}

if(isset($_GET['delete_from_cart'])){
    $order_id = $_GET['delete_from_cart'];
    $sql_delete_from_cart = "DELETE FROM orders WHERE orders_id = '$order_id'";
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
            <div class="col-8">
                <h3 class="display-3">
                    Welcome <?php echo $_SESSION['user_info_fullname']; ?>
                    
                </h3>
                <a href="?logout" class="btn btn-link">logout</a>
                
                <hr>
                
                        <?php
               
               $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' order by items_id DESC";
               $get_result = mysqli_query($conn, $sql_get_items); ?>
               <table class="table">
                   <?php
                       while ( $row = mysqli_fetch_assoc($get_result) ){ ?>
                        <tr>
                            <td><?php echo $row['item_name'];?></td>
                            <td><?php echo $row['item_desc'];?></td>
                            <td><?php echo "Php " . number_format($row['item_price'],2);?></td>
                            <td> 
                               
                                <form action="process_add_to_cart.php" method="get">
                                  <div class="input-group">
                                   <input type="text" hidden class="form-control" name="item_id" value="<?php echo $row['items_id'];?>">
                                   <input type="number" class="form-control" name="cart_qty">
                                    <input type="submit" value="Add to Cart" class="btn btn-primary">
                                </div>
                                </form>
                            </td>
                        </tr>
                       <?php }
                   ?>
               </table>
               
            </div>
            <div class="col-4">
                <h6 class="display-6">Cart</h6>
                <?php
                    $sql_get_cart_items = "SELECT i.item_name
                                                , i.item_price
                                                , i.item_desc
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
                               <td> <?php echo $cart['item_name'];?> </td>
                               <td> <?php echo $cart['item_qty'] . " pcs";?> </td>
                               <td> <?php echo "Php " . number_format($cart['item_price'] * $cart['item_qty'],2); ?> </td>
                               <td> <a href="?delete_from_cart=<?php echo $cart['orders_id'];?>" class="btn btn-danger btn-sm">x</a> </td>
                           </tr>
                    <?php }
                echo "</table>";
                ?>
                <hr>
               <a href="" class="btn btn-warning">Checkout</a>
               
            </div>
        </div>
    </div>
    
</body>
   <script src="../js/bootstrap.js"></script>
</html>