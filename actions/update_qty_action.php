<?php
include ('../controllers/order_controller.php'); // Include the controller

session_start();

if (isset($_POST['action']) && isset($_POST['order_detail_id'])) {
    $detailID = $_POST['order_detail_id'];
    $quantity = 1;
    
    // Check if the action is 'increase' or 'decrease'
    if ($_POST['action'] == 'increase') {
        $increment = increaseQtyController($detailID, $quantity); // Call the controller function to increase quantity
        if ($increment) {
            echo "Quantity increased";
            header("Location:../view/manage_orders.php");
            exit();
        }
            header('Location: ../view/manage_orders.php');
            exit();
        }
    } elseif ($_POST['action'] == 'decrease') {
        $decrement = decreaseQtyController($detailID, $quantity); // Call the controller function to decrease quantity
        if ($decrement) {
            echo "Quantity decreased";
            header('Location:../view/manage_orders.php');
            exit();
        }
        header('Location: ../view/manage_orders.php');
        exit();
    }


// Redirect back to the cart page after the update
header('Location: ../view/manage_orders.php');
exit();
?>
