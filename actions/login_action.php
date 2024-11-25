<?php

include "../controllers/user_controller.php";
require_once('../controllers/otp_controller.php');
// Check if form is submitted
if (isset($_POST['login'])) {
    // Check if email and password are set and not empty
    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Login user
        $user = loginController($email, $password);
        
        // Check if login was successful
        if ($user) {
            // Start session
            session_start();
            if (sendOTPController($email)) {
                // OTP was successfully generated and sent
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
                header("Location: ../view/otp.php");
                exit();  // Always exit after header redirects
            } else {
                // OTP generation failed
                $error = "There was an issue. Please try again.";
            header("Location: ../view/login.php?error=" . urlencode($error));
            exit();
               
            }

        } else {
            // Redirect back to login page with error message
            header("Location: ../view/login_and_register.php");
            //$message = "Error: You are not registered";
            echo "<script>alert('Error: You are not registered')</script>";
            exit();
        } 
    } else {
    // Redirect back to login page with error message
    header("Location: ../view/login_and_register.php");
    //$message = "Error: Empty fields";
    echo "<script>alert('Error: Empty fields')</script>";
    exit();
    }
} else {
// Redirect back to login page
header("Location: ../view/login_and_register.php");
//$message = "Error: Form not submitted";
echo "<script>alert('Error: Form not submitted')</script>";
exit();
}


?>
