<?php
include_once "db.php";

$uname =  $_POST['r_username'];
$passwd = $_POST['r_passwrd'];
$conf_passwd = $_POST['r_conf_passwrd'];
$address =  $_POST['r_address'];
$contact = $_POST['r_contact'];
$gender = $_POST['r_gender'];

function chk_pass($passwd, $conf_passwd){
  return ($passwd == $conf_passwd) ? True : False;
}
 
    if(! chk_pass($passwd, $conf_passwd)){
        echo "Password Mismatch!";
        die;
    }


$inputs = array("$uname","$passwd","$conf_passwd","$address","$contact","$gender");

foreach($inputs as $input){
    
    echo $input . "<br>";
}