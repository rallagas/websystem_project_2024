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
      
   </div>
    
</body>
    <script src="../js/bootstrap.js"></script>
</html>