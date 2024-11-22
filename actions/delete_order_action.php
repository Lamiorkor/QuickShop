<?php
include ('../controllers/order_controller.php');

// Get the order ID from the form submission
if (isset($_POST['order_id'])) {
    $orderID = $_POST['order_id'];

     // Call deleteOrderController
     $order = deleteOrderController($orderID);

    // Instantiate and delete the order
    if ($order !== false) {
        // Redirect to order page with success message
        echo "Order deleted successfully!";
        header("Location:../view/manage_orders.php");
        exit();
    } else {
        echo "Error deleting order";
        header("Location:../view/manage_orders.php");
        exit();
    }
}

?>