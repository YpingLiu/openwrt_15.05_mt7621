<?php  
session_start();  
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['islogin'])){
    header("Location:login.html");
    exit();
}
 
?>  