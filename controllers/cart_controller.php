<?php
// Include the Cart class
include("../classes/cart_class.php");

function addToCartController($serviceID, $customerID, $quantity) {
    // Create an instance of the Cart class
    $newCartItem = new Cart();

    // Return the addCart method
    return $newCartItem->addToCart($serviceID, $customerID, $quantity);
}

function deleteCartItemController($serviceID, $customerID) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the deleteCart method
    return $cart_item->deleteCartItem($serviceID, $customerID);
}

function getCartItemsController() {
    // Create an instance of the Cart class
    $cart_items = new Cart();

    // Return the getCart method
    return $cart_items->getCartItems();
}

function getOneCartItemController($serviceID, $customerID) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the getOneCart method
    return $cart_item->getOneCartItem($serviceID, $customerID);
}

function increaseCartItemQtyController($serviceID, $customerID, $quantity) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the getOneCart method
    return $cart_item->increaseCartItemQty($serviceID, $customerID, $quantity);
}

function decreaseCartItemQtyController($serviceID, $customerID, $quantity) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the getOneCart method
    return $cart_item->decreaseCartItemQty($serviceID, $customerID, $quantity);
}
?>