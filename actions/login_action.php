<?php

session_start();

include ("../controllers/user_controller.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set and not empty
    if (isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['password']);

        // Login user
        $user = loginController($email, $password);

        // Check if login was successful
        if ($user !== null) {
            // Start session
            session_start();

            // Store user data in session
            $_SESSION['user_id'] = $user['customer_id'];
            $_SESSION['user_email'] = $user['customer_email'];
            $_SESSION['user_name'] = $user['customer_name'];
            $_SESSION['user_role'] = $user['user_role'];

            if ($_SESSION['user_role'] == 'administrator') {
                header("Location: ../view/admin_dashboard.php");
                exit();
            }

            elseif ($_SESSION['user_role'] == 'inventory manager') {
                header("Location: ../view/inventory_dashboard.php");
                exit();
            }

            elseif ($_SESSION['user_role'] == 'customer') {
                header("Location: ../view/customer_dashboard.php");
                exit();
            }

            else {
                header("Location: ../view/customer_dashboard.php");
                exit();
            }


        } else {
            // Redirect back to login page with error message
            header("Location: ../view/login_and_register.php");
            echo "Error: You are not registered";
            exit();
        } 
    } else {
    // Redirect back to login page with error message
    header("Location: ../view/login_and_register.php");
    echo "Error: Empty fields";
    exit();
    }
} else {
// Redirect back to login page
header("Location: ../view/login_and_register.php");
exit();
}


?>
