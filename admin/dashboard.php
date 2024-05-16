<?php 
include_once "../db.php";
?>


<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
   
   <div class="container">
       <div class="row">
           <div class="col-6">
                   <div class="card ps-1">
                       <h3 class="card-title">Total Sales</h3>
                       <small class="small">Per Item</small>
                       <div class="card-body">
                           <h1 class="display-1">
                               <?php $sql_get_totalsales = " SELECT i.item_name as item_name
                                                                  , sum(o.item_qty) as total_item_qty
                                                                  , SUM(i.item_price * o.item_qty) as total_amt
                                                                FROM `orders` o
                                                                JOIN `items` i
                                                                  on o.item_id = i.items_id
                                                                GROUP BY  i.item_name
                                                              ORDER BY i.item_name DESC
                               ";
                               
                                     $sales_result = mysqli_query($conn, $sql_get_totalsales); ?>
                               
                               
                                <table class="table table-striped">
                                    <tr>
                                        <th>Date</th>
                                        <th>Total Item Qty</th>
                                        <th>Total Sales</th>
                                    </tr>
                                     <?php while($rec = mysqli_fetch_assoc($sales_result)){?>
                                    <tr>
                                        <td><?php echo $rec['item_name'];?></td>
                                        <td><?php echo $rec['total_item_qty'];?></td>
                                        <td><?php echo $rec['total_amt'];?></td>
                                    </tr>      
                                             
                                         
                                     <?php } ?>
                               
                                </table>
                               
                           </h1>
                       </div>
                   </div>
               
           </div>
           <div class="col-6">
                   <div class="card ps-1">
                       <h3 class="card-title">Total Sales</h3>
                       <small class="small">Per Day</small>
                       <div class="card-body">
                           <h1 class="display-1">
                               <?php $sql_get_totalsales = "SELECT * FROM `total_per_date`";
                               
                                     $sales_result = mysqli_query($conn, $sql_get_totalsales); ?>
                               
                               
                                <table class="table table-striped">
                                    <tr>
                                        <th>Date</th>
                                        <th>Total Item Qty</th>
                                        <th>Total Sales</th>
                                    </tr>
                                     <?php while($rec = mysqli_fetch_assoc($sales_result)){?>
                                    <tr>
                                        <td><?php echo $rec['transaction_date'];?></td>
                                        <td><?php echo $rec['total_item_qty'];?></td>
                                        <td><?php echo $rec['total_amt'];?></td>
                                    </tr>      
                                             
                                         
                                     <?php } ?>
                               
                                </table>
                               
                           </h1>
                       </div>
                   </div>
               
           </div>
           <div class="col-6">
                   <div class="card ps-1">
                       <h3 class="card-title">Total Sales</h3>
                       <small class="small">Per Order</small>
                       <div class="card-body">
                           <h1 class="display-1">
                               <?php $sql_get_totalsales = "SELECT * FROM `total_per_order`";
                               
                                     $sales_result = mysqli_query($conn, $sql_get_totalsales); ?>
                               
                               
                                <table class="table table-striped">
                                    <tr>
                                        <th>Order Reference Number</th>
                                        <th>Total Item Qty</th>
                                        <th>Total Sales</th>
                                    </tr>
                                     <?php while($rec = mysqli_fetch_assoc($sales_result)){?>
                                    <tr>
                                        <td><?php echo $rec['order_ref_number'];?></td>
                                        <td><?php echo $rec['total_item_qty'];?></td>
                                        <td><?php echo $rec['total_amt'];?></td>
                                    </tr>      
                                             
                                         
                                     <?php } ?>
                               
                                </table>
                               
                           </h1>
                       </div>
                   </div>
               
           </div>
           <div class="col-4"></div>
           <div class="col-4"></div>
       </div>
   </div>
   
    
</body>
<script src="../js/bootstrap.js"></script>
</html>


