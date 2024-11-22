<?php
// Including necessary files and classes
include ('../controllers/order_controller.php');

// Checking if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $orderID = $_POST['order_id'];
    $productDescription = $_POST['description'];
    $productPrice = $_POST['price'];
    $stock_quantity = $_POST['stock_qty'];

    // Call the update controller
    $result = updateProductController($productID, $productName, $productDescription, $productPrice, $stock_quantity);

    // Check if update was successful
    if ($result) {
        // Redirect to success page or show a success message
        header("Location: ../view/manage_products.php?status=success");
        exit(); // Exit after redirecting
    } else {
        // Redirect to error page or show an error message
        header("Location: ../view/manage_products.php?status=error");
        exit(); // Exit after redirecting
    }
}