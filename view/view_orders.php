<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../controllers/order_controller.php'); 

$user_id = $_SESSION['user_id'];
$order_details = getOrderDetailsController($user_id);

// Calculate the total amount for the entire order
// Loop through the order details and calculate the total amount for the user's orders
$total_amount = 0;
foreach ($order_details as $detail) {
    $order_id = $detail['order_id']; // Get the order ID
    $total_amount = calculateTotalAmountController($order_id); // Add the total for this specific order
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order Details - Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 fixed w-full z-10 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <a href="home.php" class="text-white text-2xl font-bold">QuickShop</a>
            <div class="flex items-center space-x-4">
                <a href="home.php" class="text-gray-300 hover:text-white">Home</a>
                <a href="products.php" class="text-gray-300 hover:text-white">Products</a>
                <a href="view_orders.php" class="text-gray-300 hover:text-white">Orders</a>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="text-gray-300">Hello, <?php echo $_SESSION['user_name']; ?>!</span>
                    <a href="../actions/logout_action.php" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="login_and_register.php" class="text-gray-300 hover:text-white">Login/Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content with top padding to account for fixed navbar -->
    <div class="flex pt-16 h-screen">
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">View Orders</h2>
                    <div class="flex items-center">
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <span class="text-black-300">Hello, <?php echo $_SESSION['user_name']; ?>!</span>
                            <a href="cart.php" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-shopping-cart"></i> View Cart
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </header>

            <!-- Orders Content -->
            <main class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Order List</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-3 text-left">Order ID</th>
                                <th class="p-3 text-left">Order Date</th>
                                <th class="p-3 text-left">Product Name</th>
                                <th class="p-3 text-left">Quantity</th>
                                <th class="p-3 text-left">Price</th>
                                <th class="p-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($order_details): ?>
                                <?php foreach ($order_details as $detail): ?>
                                    <tr class="border-t">
                                        <td class="p-3"><?php echo $detail['order_id']; ?></td>
                                        <td class="p-3"><?php echo $detail['order_date']; ?></td>
                                        <td class="p-3"><?php echo $detail['pname']; ?></td>
                                        <td class="p-3"><?php echo $detail['qty']; ?></td>
                                        <td class="p-3">$<?php echo number_format($detail['price'], 2); ?></td>
                                        <td class="p-3"><?php echo $detail['order_status']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="p-3 text-center text-gray-500">No orders available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Total Amount -->
                <?php if ($total_amount > 0): ?>
                    <div class="bg-gray-50 p-4 mt-6 rounded-lg shadow-sm">
                        <h4 class="text-xl font-semibold">Total Amount: $<?php echo number_format($total_amount, 2); ?></h4>
                    </div>
                <?php else: ?>
                    <div class="bg-gray-50 p-4 mt-6 rounded-lg shadow-sm">
                        <h4 class="text-xl font-semibold">No orders available</h4>
                    </div>
                <?php endif; ?>

            </main>
        </div>
    </div>
</body>
</html>
