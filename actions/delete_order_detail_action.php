<?php
require_once ("../controllers/order_controller.php");

// Get the order ID from the form submission
if (isset($_POST['order_detail_id'])) {
    $orderDetailID = $_POST['order_detail_id'];

     // Call deleteOrderController
     $orderDetail = deleteOrderDetailController($orderDetailID);

    // Instantiate and delete the order
    if ($orderDetail !== false) {
        // Redirect to order page with success message
        echo "Order Detail deleted successfully!";
        if($_SESSION['user_role'] === 'administrator' || $_SESSION['user_role'] === 'sales personnel') {
            header("Location:../view/manage_orders.php");
            exit();
        } else {
            header("Location:../view/view_orders.php");
            exit();
        }
      
    } else {
        echo "Error deleting order detail";
        if ($_SESSION['user_role'] === 'administrator' || $_SESSION['user_role'] === 'sales personnel') {
            header("Location:../view/manage_orders.php");
            exit();
        } else {
        header("Location:../view/view_orders.php");
        exit();
        }
    }
}

?>