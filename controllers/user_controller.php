<?php
// Include the User class
require_once("../classes/user_class.php");


function registerController($name, $email, $password) {
    // Create an instance of the User class
    $new_user = new User();

    // Return the register method
    return $new_user->addUser($name, $email, $password);
}

// function loginController($email, $password) {
//     // Create an instance of the User class
//     $old_user = new User();
    
//     // Return the login method
//     return $old_user->login($email, $password); 
// }

function loginController($email, $password) {
    // Create an instance of the User class
    $old_user = new User();
    
    // Return the login method
    return $old_user->login($email, $password); 
}
  

function getAllCustomersController() {
    // Create an instance of the User class
    $all_customers = new User();

    // Return the getAllCustomers method
    return $all_customers->getAllCustomers();
}

function getAllUsersController() {
    // Create an instance of the User class
    $users = new User();

    // Return the getAllUsers method
    return $users->getAllUsers();
}

function addRequestController($user_id, $role) {
    // Create an instance of the User class
    $new_request = new User();

    // Return the addRequest method
    return $new_request->addRequest($user_id, $role);
}

function changeRoleToAdminController($user_id) {
    // Create an instance of the User class
    $request = new User();

    // Return the changeUserRoleToAdmin method
    return $request->changeRoleToAdmin($user_id);
}

function changeRoleToInvManController($user_id) {
    // Create an instance of the User class
    $request = new User();

    // Return the changeUserRoleToAdmin method
    return $request->changeRoleToInvMan($user_id);
}

function changeRoleToSalesPrsnlController($user_id) {
    // Create an instance of the User class
    $request = new User();

    // Return the changeUserRoleToAdmin method
    return $request->changeRoleToSalesPrsnl($user_id);
}

function changeRoleToCustomerController($user_id) {
    // Create an instance of the User class
    $request = new User();

    // Return the changeUserRoleToAdmin method
    return $request->changeRoleToCustomer($user_id);
}

?>