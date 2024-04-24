<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
               <h3 class="display-3">Registration Form</h3>
               <?php
                if(isset($_GET['error'])){
                    echo "Error:" . $_GET['error'];
                }
                ?>
                <form action="process_registration.php" method="POST">
                    <div class="mb">
                       <label for="" class="form-label">Fullname</label>
                        <input name="r_fullname" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Username</label>
                        <input name="r_username" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Password</label>
                        <input name="r_passwrd" type="password" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Confirm Password</label>
                        <input name="r_conf_passwrd" type="password" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Address</label>
                        <input name="r_address" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Contact</label>
                        <input name="r_contact" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Birth Certified Gender</label>
                             <select class="form-select" name="r_gender" id="">
                                 <option value="M">Male</option>
                                 <option value="F">Female</option>
                                 <option value="X">Rather Not Say</option>
                             </select>
                         
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success">
                        
                        <a href="index.php" class="btn btn-link">Login</a>
                        
                    </div>
                </form>
                
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    
</body>
    <script src="js/bootstrap.js"></script>
</html>