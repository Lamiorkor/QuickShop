<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Including necessary files and classes
include ('../controllers/order_controller.php');

// Checking if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $orderID = $_POST['order_id'];
    $totalAmount = $_POST['total_amt'];
    $status = $_POST['status'];

    // Call the update controller
    $result = updateOrderController($orderID, $totalAmount, $status);

    // Check if update was successful
    if ($result) {
        // Redirect to success page or show a success message
        header("Location: ../view/manage_orders.php?status=success");
        exit(); // Exit after redirecting
    } else {
        // Redirect to error page or show an error message
        header("Location: ../view/manage_orders.php?status=error");
        exit(); // Exit after redirecting
    }
}