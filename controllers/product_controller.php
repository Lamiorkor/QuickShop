<?php
// Include the Product class
include("../classes/product_class.php");

function addProductController($pname, $description, $price, $stock_qty) {
    // Create an instance of the Product class
    $newProduct = new Product();

    // Return the addProduct method
    return $newProduct->addProduct($pname, $description, $price, $stock_qty);
}

function deleteProductController($productID) {
    // Create an instance of the Product class
    $product = new Product();

    // Return the deleteProduct method
    return $product->deleteProduct($productID);
}

function getProductsController() {
    // Create an instance of the Product class
    $products = new Product();

    // Return the getProducts method
    return $products->getProducts();
}

function getOneProductController($productID) {
    // Create an instance of the Product class
    $product = new Product();

    // Return the getOneService method
    return $product->getOneProduct($productID);
}

function updateProductController($productID, $pname, $description, $price, $stock_qty) {
    // Create an instance of the Product class
    $product = new Product();

    // Return the getOneProduct method
    return $product->editProduct($productID, $pname, $description, $price, $stock_qty);
}


?>