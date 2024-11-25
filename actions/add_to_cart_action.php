<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('../controllers/cart_controller.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $productID = $_POST['product_id'];
    $userID = $_SESSION['user_id'];
    $quantity = 1;

    // Call addToCartController
    $newCartItem = addToCartController($userID, $productID, $quantity);

    // Check if addition was successful
    if ($newCartItem !== false) {
        // Redirect to product page with success message
        echo "Item added to cart successfully!";
        if ($_SESSION['user_role'] == 'administrator' || $_SESSION['user_role'] == 'sales personnel') {
            header("Location:../view/manage_products.php");
            exit();
        }
        header("Location:../view/products.php");
        exit();
    } else {
        // Redirect to product page with error message
        echo "Addition to cart failed. Please try again.";
        if ($_SESSION['user_role'] == 'administrator' || $_SESSION['user_role'] == 'sales personnel') {
            header("Location:../view/manage_products.php");
            exit();
        }
        header("Location:../view/products.php");
        exit();
    } 
}

?>
