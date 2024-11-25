<?php
// Include the Cart class
include("../classes/cart_class.php");

function addToCartController($userID, $productID, $quantity) {
    // Create an instance of the Cart class
    $newCartItem = new Cart();

    // Return the addCart method
    return $newCartItem->addToCart($userID, $productID, $quantity);
}

function deleteCartItemController($productID, $userID) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the deleteCart method
    return $cart_item->deleteCartItem($productID, $userID);
}

function getCartItemsController($userID) {
    // Create an instance of the Cart class
    $cart_items = new Cart();

    // Return the getCart method
    return $cart_items->getCartItems($userID);
}

function getOneCartItemController($productID, $userID) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the getOneCart method
    return $cart_item->getOneCartItem($productID, $userID);
}

function increaseCartItemQtyController($productID, $userID, $quantity) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the getOneCart method
    return $cart_item->increaseCartItemQty($productID, $userID, $quantity);
}

function decreaseCartItemQtyController($productID, $userID, $quantity) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the getOneCart method
    return $cart_item->decreaseCartItemQty($productID, $userID, $quantity);
}

function getCartItemsCostController($userID) {
    // Create an instance of the Cart class
    $cart_items = new Cart();

    // Return the getCart method
    return $cart_items->getCartItemsCost($userID);
}

function clearCartController($userID) {
    // Create an instance of the Cart class
    $cart_item = new Cart();

    // Return the getOneCart method
    return $cart_item->clearCart($userID);
}
?>