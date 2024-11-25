<?php
// Including necessary files and controllers
include('../controllers/user_controller.php');

// Checking if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $userID = $_POST['user_id'];
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    // Call the update controller function
    $result = updateUserController($userID,$fullName, $email, $password);

    // Check if the update was successful
    if ($result) {
        // Redirect to a success page or show a success message
        header("Location: ../view/home.php?status=success");
        exit(); // Exit after redirecting
    } else {
        // Redirect to an error page or show an error message
        header("Location: ../view/home.php?status=error");
        exit(); // Exit after redirecting
    }
}
?>
