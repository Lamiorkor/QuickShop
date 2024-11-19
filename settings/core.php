<?php
//start session
session_start(); 

//for header redirection
ob_start();

//function to check for login
function userIDSessionCheck() {  
    if (!isset($_SESSION['user_id'])) {
        header("Location:../view/login.php");
        die("Please login again");
    } 
}


//function to get user ID
function userIDCheck(){
    echo $_SESSION['user_id'];
    return $_SESSION['user_id'];
}

//function to check for role (admin, customer, etc)
function userRoleIDSessionCheck() {
    if(!isset($_SESSION['user_id'])) {
        return false;
    } else {
        return $_SESSION['user_role'];
    }
}


?>