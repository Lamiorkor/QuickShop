<?php
include ('../controllers/order_controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $customer_id = $_POST['customer'];
    $order_date = $_POST['order_date'];
    $totalAmt = $_POST['total_amount'];

    // Call addOrderController
    $newOrder = addOrderController($customer_id, $order_date, $totalAmt);

    // Check if addition was successful
    if ($newOrder !== false) {
        // Redirect to orders page with success message
        echo "Order added successfully!";
        header("Location:../view/manage_orders.php");
        exit();
    } else {
        // Redirect to orders page with error message
        echo "Addition of order failed. Please try again.";
        header("Location:../view/manage_orders.php");
        exit();
    }
}

?>
