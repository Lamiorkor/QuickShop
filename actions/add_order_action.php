<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../controllers/order_controller.php');
require_once('../controllers/cart_controller.php');

session_start();

// Fetch cart items for the logged-in user
$cartItems = getCartItemsController($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $customer_id = $_POST['user_id'];
    $order_date = date('Y-m-d H:i:s');
    $totalAmt = $_POST['total_amount'];

    // Call addOrderController
    $newOrder = addOrderController($customer_id, $order_date, $totalAmt);

    // Check if addition was successful
    if ($newOrder !== false) {
        foreach ($cartItems as $product) {
            $productID = $product['product_id'];
            $quantity = $product['qty'];
            $productPrice = $product['price'];
    
            // Call orderDetailsController
            $orderDetails = addOrderDetailsController($newOrder, $productID, $quantity, $productPrice);

            if (!$orderDetails) {
                echo "Addition of order details failed. Please try again.";
                if ($_SESSION['user_role'] === 'administrator' || $_SESSION['user_role'] === 'sales personnel') {
                    header("Location:../view/manage_orders.php");
                    exit();
                } else {
                    header("Location:../view/view_orders.php");
                    exit();
                }
            }
        }
        
        // Clear the cart after order and order details are successfully added
        $clearCart = clearCartController($_SESSION['user_id']);
        if ($clearCart) {
            // Redirect to orders page with success message
            echo "Order added successfully and cart cleared!";
            if ($_SESSION['user_role'] === 'administrator' || $_SESSION['user_role'] === 'sales personnel') {
                header("Location:../view/manage_orders.php");
                exit();
            } else {
                header("Location:../view/view_orders.php");
                exit();
            }
        } else {
            echo "Order added successfully, but failed to clear cart.";
            // You could log this issue or display a message to the user here if needed
        }
    } else {
        // Redirect to orders page with error message
        echo "Addition of order failed. Please try again.";
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
