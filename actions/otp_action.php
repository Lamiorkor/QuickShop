<?php
// Include the OTP controller
require('../controllers/otp_controller.php');
require('../controllers/user_controller.php');
session_start();

// Check if the user is logged in (user_id is set in the session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if session is invalid
    $error = "Your Session has is invalid or expired.";
    header("Location: ../view/login_and_register.php?error=" . urlencode($error));
    
    exit();
}

// Check if the request is to regenerate OTP (this is for the AJAX request)
if (isset($_POST['action']) && $_POST['action'] == 'regenerate_otp') {
    
    $email = $_SESSION['email'];
    // Call a function from the OTP controller to generate and send the OTP
    if (sendOTPController($email)) {
        // OTP was successfully generated and sent
        echo json_encode(['status' => 'success', 'message' => 'New OTP has been sent to your email.']);
    } else {
        // OTP generation failed
        echo json_encode(['status' => 'error', 'message' => 'There was an issue generating the OTP.']);
    }
    exit();
}

// Check if the form is submitted for OTP validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

   // Login user
    $user = loginController($email, $password);
    
    // Get form inputs
    $userOtpInput = $_POST['otp'];
    $user_id = $_SESSION['user_id'];
    
    
    // Validate the OTP using the controller
    if (validateOTPController($user_id, $userOtpInput)) {
        // Success - redirect to success page
        Store user data in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            if ($_SESSION['user_role'] === 'administrator') {
                header("Location: ../view/admin.php");
                exit();
            }

            elseif ($_SESSION['user_role'] === 'inventory manager') {
                header("Location: ../view/manage_products.php");
                exit();
            }

            elseif ($_SESSION['user_role'] === 'sales personnel') {
                header("Location: ../view/manage_orders.php");
                exit();
            }

            else {
                header("Location: ../view/home.php");
                exit();
            } 
    } else {
        // OTP validation failed, redirect back to OTP page with an error
        $error = "OTP invalid or expired. Generate a new otp with the button.";
        header("Location: ../view/otp.php?error=" . urlencode($error));
        exit();
    }
}
?>
