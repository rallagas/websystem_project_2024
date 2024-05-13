<html>
<?php include_once "db.php"; 
session_start();
if($_SESSION['user_info_user_type'] == 'A'){
   header("location: admin/");   
}

if($_SESSION['user_info_user_type'] == 'C'){
   header("location: common_user/");
}
    

    ?>
   <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
   
   <div class="container-fluid">
       <?php include_once "header_index.php"; ?>
    
       <div class="row">
           <?php
                                               
               $sql_get_items = "SELECT * FROM `items` WHERE `item_status`='A' order by items_id DESC";
               $get_result = mysqli_query($conn, $sql_get_items); ?>
             
                   <?php
                       while ( $row = mysqli_fetch_assoc($get_result) ){ ?>
                               <div class="col-3 p-0">
                                   <div class="card">
                                       <img src="img/<?php echo $row['item_img'];?>" width="100px" class="card-img">
                                       <div class="card-body">
                                           <h3 class="card-title">
                                               <?php echo $row['item_name'];?>
                                           </h3>
                                           <p class="card-text"><?php echo $row['item_desc'];?></p>
                                             <blockquote class="blockquote mb-0">
                                                  <p><?php echo "Php " . number_format($row['item_price'],2);?></p>
                                                </blockquote>
                                            
                                       </div>
                                       <div class="card-footer">
                                                                                               <a href="" class="btn btn-primary">Log-in to Buy</a>

                                       </div>
                                       
                                   </div>
                               </div>
                       <?php }
                   ?>
          
               
       </div>
   </div>
    
</body>
    <script src="js/bootstrap.js"></script>
</html>