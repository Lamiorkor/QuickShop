<?php
include ('../controllers/cart_controller.php'); // Include the controller

session_start();

if (isset($_POST['action']) && isset($_POST['product_id'])) {
    $productID = $_POST['product_id'];
    $userID = $_SESSION['user_id'];
    $quantity = 1;
    
    // Check if the action is 'increase' or 'decrease'
    if ($_POST['action'] == 'increase') {
        $increment = increaseCartItemQtyController($productID, $userID, $quantity); // Call the controller function to increase quantity
        if ($increment) {
            echo "Quantity increased";
            if ($_SESSION['user_role'] == 2) {
                header("Location:../view/user_cart.php");
                exit();
            }
            header('Location: ../view/cart.php');
            exit();
        }
    } elseif ($_POST['action'] == 'decrease') {
        $decrement = decreaseCartItemQtyController($productID, $userID, $quantity); // Call the controller function to decrease quantity
        if ($decrement) {
            echo "Quantity decreased";
            header('Location:../view/cart.php');
            exit();
        }
    }
}

// Redirect back to the cart page after the update
header('Location: ../view/cart.php');
exit();
?>
