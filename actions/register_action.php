<?php
require_once ('../controllers/user_controller.php');

//session_start();

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call registerController
    $registerUser = registerController($name, $email, $password);

    // Check if registration was successful
    if ($registerUser !== false) {
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

?>
