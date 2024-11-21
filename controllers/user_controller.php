<?php
// Include the User class
include "../classes/user_class.php";

function registerController($name, $email, $password) {
    // Create an instance of the User class
    $new_user = new User();

    // Return the register method
    return $new_user->addUser($name, $email, $password);
}

function loginController($email, $password) {
    // Create an instance of the User class
    $old_user = new User();
    
    // Return the login method
    return $old_user->login($email, $password); 
}

function changeRoleToAdminController($user_id) {
    // Create an instance of the User class
    $user = new User();

    // Return the changeUserRoleToAdmin method
    return $user->changeRoleToAdmin($user_id);
}

function changeRoleToInvManController($user_id) {
    // Create an instance of the User class
    $user = new User();

    // Return the changeUserRoleToAdmin method
    return $user->changeRoleToInvMan($user_id);
}

function changeRoleToSalesPnlController($user_id) {
    // Create an instance of the User class
    $user = new User();

    // Return the changeUserRoleToAdmin method
    return $user->changeRoleToSalesPnl($user_id);
}

function changeRoleToCustomerController($user_id) {
    // Create an instance of the User class
    $user = new User();

    // Return the changeUserRoleToAdmin method
    return $user->changeRoleToCustomer($user_id);
}
?>