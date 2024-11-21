<?php
include ('../controllers/user_controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

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
