<?php
include ('../controllers/user_controller.php');

if (isset($_POST['signup'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

     // Call registerController
     $registerUser = registerController($name, $email, $hashed_password);


    // Check if registration was successful
    if ($registerUser !== false) {
        // Redirect to login page with success message
        header("Location:../view/login_and_register.php");
        exit();
    } else {
        // Redirect to registration page with error message
        echo "Registration failed. Please try again.";
        header("Location:../view/login_and_register.php");
        exit();
    }
}

?>
