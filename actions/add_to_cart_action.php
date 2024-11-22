<?php
include ('../controllers/cart_controller.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $serviceID = $_POST['serviceID'];
    $customerID = $_SESSION['user_id'];
    $quantity = 1;

    // Call addToCartController
    $newCartItem = addToCartController($serviceID, $customerID, $quantity);

    // Check if addition was successful
    if ($newCartItem !== false) {
        // Redirect to service page with success message
        echo "Item added to cart successfully!";
        if ($_SESSION['user_role'] == 2) {
            header("Location:../view/customer_services.php");
            exit();
        }
        header("Location:../view/services.php");
        exit();
    } else {
        // Redirect to service page with error message
        echo "Addition to cart failed. Please try again.";
        if ($_SESSION['user_role'] == 2) {
            header("Location:../view/customer_services.php");
            exit();
        }
        header("Location:../view/services.php");
        exit();
    } 
}

?>
