<html>
<?php include_once "../db.php"; 
session_start();
$s_user_id = $_SESSION['user_info_id'];
if($_SESSION['user_info_user_type'] != 'A'){
    header("location: ../index.php");
}
if(isset($_GET['logout'])){
    session_destroy();
    header("location: ../index.php");
    die();
}


    ?>
   <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
   
   <a href="?logout" class="btn btn-link">Logout</a>

   <div class="container">
  
      

   <a href="?manageitems" class="btn btn-link">Manage Items</a>
   <a href="?manageorder" class="btn btn-link">Manage Orders</a>
   <a href="?dashboard" class="btn btn-link">Dashboards</a>
   <div class="container">
    
  
      <?php if(isset($_GET['manageitems'])) { ?>

       <div class="row">
           <div class="col-4 bg-success text-light">
             <?php
               if(isset($_GET['deactivate_item'])){
                   $item_id = $_GET['deactivate_item'];
                   $sql_deactivate_item = "UPDATE `items`
                                             SET `item_status`='I'
                                           WHERE `items_id`='$item_id'";
                   mysqli_query($conn, $sql_deactivate_item);
               }
               
               
               if(isset($_GET['update_item'])){
                   $item_id = $_GET['update_item'];
                   
                   $sql_get_item_info = "SELECT * FROM `items`
                                          WHERE items_id = '$item_id'";
                   $result = mysqli_query($conn, $sql_get_item_info);
                   $data_row = mysqli_fetch_assoc($result);
                   ?>    
                   <h3 class="display-6">Update Item Info</h3>
                   <form action="process_update_item.php" method="POST">
                      
                          <input hidden value="<?php echo $data_row['items_id'];?>" type="text" name="u_item_id" readonly class="form-control mb-3">
                      
                        <label for="">Item Name</label>
                       <input value="<?php echo $data_row['item_name'];?>" type="text" name="u_item_name" class="form-control mb-3">

                      <label for="">Item Description</label>
                       <input value="<?php echo $data_row['item_desc'];?>"  type="text" name="u_item_desc" class="form-control mb-3">

                      <label for="">Item Price</label>
                       <input value="<?php echo $data_row['item_price'];?>"  type="text" name="u_item_price" class="form-control mb-3">

                      <input type="submit" class="btn btn-primary">
                   </form>
                   
                   <?php
               }
               
               ?>
             
             
             
             <hr>
              <h3 class="display-6">Add New Item</h3>
              
                  <?php 
                      if(isset($_GET['insert_status'])){
                          echo "<div class='alert alert-warning'>";
                              if($_GET['insert_status'] == '1') {
                                  echo "Item Added Successfully.";
                              }
                              else{
                                  echo "There was an error.";
                              }
                          echo "</div>";
                      }
                  ?>
               <form action="process_new_item.php" method="POST" enctype="multipart/form-data">
                  <label for="">Item Name</label>
                   <input type="text" name="f_item_name" class="form-control mb-3">
                  
                  <label for="">Item Description</label>
                   <input type="text" name="f_item_desc" class="form-control mb-3">
                  
                  <label for="">Item Price</label>
                   <input type="text" name="f_item_price" class="form-control mb-3">
                  
                  <label for="">Item Image</label>
                      <input type="file" class="form-control mb-3" name="f_item_img">
                  <input type="submit" class="btn btn-primary">
               </form>
           </div>
           <div class="col-8">
      
               <?php
                                               
               $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' order by items_id DESC";
               $get_result = mysqli_query($conn, $sql_get_items); ?>
               <table class="table">
                   <?php
                       while ( $row = mysqli_fetch_assoc($get_result) ){ ?>
                        <tr>
                            <td> <img src="../img/<?php echo $row['item_img'];?>" alt="" class="img-fluid" width="100px"> </td>
                            <td><?php echo $row['item_status'];?></td>
                            <td><?php echo $row['item_name'];?></td>
                            <td><?php echo $row['item_desc'];?></td>
                            <td><?php echo "Php " . number_format($row['item_price'],2);?></td>
                            <td> <a href="index.php?update_item=<?php echo $row['items_id'];?>" class="btn btn-success">Update</a> </td>
                            <td> <a href="index.php?deactivate_item=<?php echo $row['items_id'];?>" class="btn btn-danger">Deactivate</a> </td>
                        </tr>
                       <?php }
                   ?>
               </table>
               
           
               
           </div>
       </div>
       <?php } ?>
      
      <?php if(isset($_GET['manageorder'])) { ?>
      <div class="row">
          <div class="col-12">
              
              <h3 class="display-3">Orders</h3>
              
              <a href="?manageorder&orderphase=2" class="btn btn-link">New</a>
              <a href="?manageorder&orderphase=3" class="btn btn-link">Pending</a>
              <a href="?manageorder&orderphase=4" class="btn btn-link">To Ship</a>
              <a href="?manageorder&orderphase=5" class="btn btn-link">Out For Delivery</a>
              <a href="?manageorder&orderphase=0" class="btn btn-link">Cancelled</a>
          </div>
          <div class="container-fluid">
        
            
           
            <?php if(isset($_GET['orderphase']) || isset($_GET['manageorder'])){ 
              $orderphase = $_GET['orderphase'];
              ?>
             <div class="row">
              <?php
                 $sql_get_user_order = "SELECT DISTINCT 
                                                  o.order_ref_number
                                                , pm.payment_method_desc
                                                , op.order_phase_desc
                                                , ui.fullname
                                                , ui.address
                                             FROM `orders` as o
                                             JOIN `payment_method` as pm
                                               ON o.payment_method = pm.payment_method_id
                                             JOIN `order_phase` as op
                                               ON o.order_phase = op.order_phase_id
                                             JOIN `user_info` as ui
                                               ON o.user_id = ui.user_info_id
                                            WHERE ui.user_type = 'C'
                                              AND ui.user_status = 'A'
                                              AND o.order_phase = '$orderphase'";      
                    $result_orders = mysqli_query($conn, $sql_get_user_order);
              
              while($ro = mysqli_fetch_assoc($result_orders)){ //first loop for the order reference number ?> 
                      <div class="col-3">
                          <div class="card">
                              <p class="card-title">
                                  <?php echo $ro['order_ref_number'];?> <br>
                                  
                                  <small>Recipient: <?php echo strtoupper($ro['fullname']);?></small> <br>
                                  <small>Address: <?php echo strtoupper($ro['address']);?></small>
                              </p>
                              <?php  
                              $curr_order_ref_number = "";
                              $curr_order_ref_number = $ro['order_ref_number'];
                            
                              $sql_get_order_items = "SELECT i.item_name
                                                          , i.item_img
                                                          , i.item_price
                                                          , o.item_qty
                                                       FROM `orders` as o
                                                       JOIN `items` as i
                                                         ON o.item_id = i.items_id
                                                        WHERE o.order_ref_number = '$curr_order_ref_number'";
                              $order_items_result = mysqli_query($conn, $sql_get_order_items);
                                                          
                              ?>
                              <ul class="list-group">
                                  <?php while ($itord = mysqli_fetch_assoc($order_items_result)){ 
                                  //inner 2nd loop to list all the items of the specified order reference number ?>
                                      
                                  <li class="list-group-item"><?php echo $itord['item_name'] . " x " . $itord['item_qty'] . " = <br><small>" . "Php " . number_format($itord['item_qty'] * $itord['item_price'], 2) . "</small>"; ?></li>
                                <?php   } ?>
                                
                                
                              <li class="list-group-item">
                                 <?php if($_GET['orderphase'] == '2') { ?>
                                  <a href="process_confirm_order.php?confirm_order=<?php echo $curr_order_ref_number; ?>" class="btn btn-success">Confirm</a>
                                  <?php } ?>
                                 <?php if($_GET['orderphase'] == '3') { ?>
                                  <a href="process_confirm_order.php?ship_order=<?php echo $curr_order_ref_number; ?>" class="btn btn-primary">Ship</a>
                                  <?php } ?>
                                 <?php if($_GET['orderphase'] == '4') { ?>
                                  <a href="process_confirm_order.php?complete_order=<?php echo $curr_order_ref_number; ?>" class="btn btn-primary">Complete</a>
                                  <?php } ?>
                              </li>    
                              </ul>
                              
                          </div>
                          
                      </div>
              <?php }
              ?>
              </div>
            <?php } ?>
         </div> 
          
      </div>
      <?php } ?>
      <?php if(isset($_GET['dashboard'])){
    
                include_once "dashboard.php";
    
        }?>
   </div>
    
</body>
    <script src="../js/bootstrap.js"></script>
</html>