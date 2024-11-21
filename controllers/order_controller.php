<?php
// Include the order class
include("../classes/order_class.php");

function addOrderController($userID, $orderDate, $amount) {
    // Create an instance of the Order class
    $newOrder = new Orders();

    // Return the addOrder method
    return $newOrder->addOrder($userID, $orderDate, $amount);
}

function addOrderDetailsController($orderID, $productID, $quantity, $productPrice) {
    // Create an instance of the Order class
    $newOrderDetails = new Orders();

    // Return the addOrder method
    return $newOrderDetails->addOrderDetails($orderID, $productID, $quantity, $productPrice);
}

function deleteOrderController($orderID) {
    $order = new Orders();

    // Return the deleteOrder method
    return $order->deleteOrder($orderID);
}

function getOrdersController() {
    // Create an instance of the Order class
    $orders = new Orders();

    // Return the getOrders method
    return $orders->getOrders();
}

?>