<?php
include ('../controllers/product_controller.php');

// Get the service ID from the form submission
if (isset($_POST['product_id'])) {
    $productID = $_POST['product_id'];

     // Call deleteProductController
     $product = deleteProductController($productID);

    // Instantiate and delete the product
    if ($product !== false) {
        // Redirect to product page with success message
        echo "Product deleted successfully!";
        header("Location:../view/manage_products.php");
        exit();
    } else {
        echo "Error deleting product";
        header("Location:../view/manage_products.php");
        exit();
    }
}

?>