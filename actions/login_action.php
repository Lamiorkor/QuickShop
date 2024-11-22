<?php

include "../controllers/user_controller.php";

// Check if form is submitted
if (isset($_POST['login'])) {
    // Check if email and password are set and not empty
    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Login user
        $user = loginController($email, $password);

        // Check if login was successful
        if ($user !== false) {
            // Start session
            session_start();

            // Store user data in session
            $_SESSION['user_id'] = $user['customer_id'];
            $_SESSION['user_email'] = $user['customer_email'];
            $_SESSION['user_name'] = $user['customer_name'];
            $_SESSION['user_role'] = $user['user_role'];

            if ($_SESSION['user_role'] === 'administrator') {
                header("Location: ../view/manage_products.php");
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
