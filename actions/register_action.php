<?php
include "../controllers/user_controller.php";

//session_start();

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $requested_role = $_POST['rolerequest'];
    // $user_id = $_SESSION['user_id'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Call registerController
    $registerUser = registerController($name, $email, $hashed_password);

    // Call addRequestController
    //$role_request = addRequestController($user_id, $requested_role);

    // Check if registration was successful
    if ($registerUser !== false) {
        // if($role_request !== null) {
        // Redirect to login page with success message
        header("Location:../view/login_and_register.php");
        exit();
        } else {
            // Redirect to registration page with error message
            echo "Request failed. Please try again.";
            header("Location:../view/login_and_register.php");
            exit();
        }
    } else {
        // Redirect to registration page with error message
        echo "Registration failed. Please try again.";
        header("Location:../view/login_and_register.php");
        exit();
    }
//}

?>
