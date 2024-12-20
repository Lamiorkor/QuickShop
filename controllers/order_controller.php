<?php
// Include the order class
require_once("../classes/order_class.php");

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

function getOneOrderController($orderID) {
    // Create an instance of the Order class
    $order = new Orders();

    // Return the getOneOrder method
    return $order->getOneOrder($orderID);
}

function updateOrderController($orderID, $totalAmount, $status) {
    // Create an instance of the Order class
    $order = new Orders();

    // Return the getOneProduct method
    return $order->editOrder($orderID, $totalAmount, $status);
}

function updateOrderDetailController($orderID, $productID, $qty) {
    // Create an instance of the Order class
    $order = new Orders();

    // Return the getOneProduct method
    return $order->editOrderDetail($orderID, $productID, $qty);
}

function getOrderDetailsController($userID) {
    // Create an instance of the Order class
    $order = new Orders();

    // Return the getOrderDetails method
    return $order->getOrderDetailsByUser($userID);
}

function deleteOrderDetailController($orderDetailID) {
    $order = new Orders();

    // Return the deleteOrder method
    return $order->deleteOrderDetail($orderDetailID);
}

function getAllOrderDetailsController() {
    // Create an instance of the Order class
    $order = new Orders();

    // Return the getOrderDetails method
    return $order->getAllOrderDetails();
}

function getTotalOrdersCount(){
    // Create an instance of the Order class
    $order = new Orders();

    // Return the getOneProduct method
    return $order->getTotalOrders();
}

function getTotalOrderRevenueController(){
    // Create an instance of the Order class
    $order = new Orders();

    // Return the getOneProduct method
    return $order->getTotalOrderAmounts();
    
} 

function calculateTotalAmountController($orderID) {
    // Create an instance of the Order class
    $order = new Orders();

    // Calculate the total amount for the given order ID
    $totalAmount = $order->calculateTotalAmount($orderID);

    // Ensure it's a valid amount, otherwise return 0
    return ($totalAmount !== false) ? $totalAmount : 0;
}


function updateTotalAmountController($orderID) {
    // Create an instance of the Order class
    $order = new Orders();

    // Return the updateTotalAmount method
    return $order->updateTotalAmount($orderID);
}

function increaseQtyController($detailID, $quantity) {
    // Create an instance of the Order class
    $order = new Orders();

    // Return the increaseQty method
    return $order->increaseQty($detailID, $quantity);
}

function decreaseQtyController($detailID, $quantity) {
    // Create an instance of the Order class
    $order = new Orders();

    // Return the decreaseQty method
    return $order->decreaseQty($detailID, $quantity);
}

?>