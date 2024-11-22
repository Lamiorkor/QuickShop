<?php
include ('../controllers/product_controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $productName = $_POST['pname'];
    $productDescription = $_POST['description'];
    $productPrice = $_POST['price'];
    $qty = $_POST['stock_qty'];

    // Call addProductController
    $newProduct = addProductController($productName, $productDescription, $productPrice, $qty);

    // Check if registration was successful
    if ($newProduct !== false) {
        // Redirect to product page with success message
        echo "Product added successfully!";
        header("Location:../view/manage_products.php");
        exit();
    } else {
        // Redirect to product page with error message
        echo "Addition of product failed. Please try again.";
        header("Location:../view/manage_products.php");
        exit();
    }
}

?>
