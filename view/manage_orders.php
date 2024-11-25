<?php
session_start();
$role = "administrator";
require_once('../controllers/order_controller.php');
$orders = getOrdersController(); // Fetch all orders
$order_details = getAllOrderDetailsController(); // Fetch all order details
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <a href="admin.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <?php if ($role === 'administrator' || $role === 'sales personnel' || $role === 'inventory manager') { ?>
                    <a href="manage_orders.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                        <i class="fas fa-shopping-cart mr-3"></i> Orders
                    </a>
                <?php } ?>
                <?php if ($role === 'administrator' || $role === 'sales personnel' || $role === 'inventory manager') { ?>
                    <a href="manage_products.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                        <i class="fas fa-box mr-3"></i> Manage Products
                    </a>
                <?php } ?>
                <?php if ($role === 'administrator') { ?>
                    <a href="manage_roles.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                        <i class="fas fa-users-cog mr-3"></i> Manage Roles
                    </a>
                <?php } ?>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Orders</h2>
                    <div class="flex items-center">
                        <span class="mr-4"><?php echo $_SESSION['user_name']; ?></span>
                        <a href="../actions/logout_action.php" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </header>

            <!-- Orders Content -->
            <main class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">All Orders</h3>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-3 text-left">Order ID</th>
                                <th class="p-3 text-left">Customer</th>
                                <th class="p-3 text-left">Date Ordered</th>
                                <th class="p-3 text-left">Total Amount</th>
                                <th class="p-3 text-left">Status</th>
                                <?php if ($role === 'administrator' || $role === 'sales personnel') { ?>
                                    <th class="p-3 text-left">Actions</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) { ?>
                                <tr class="border-t">
                                    <td class="p-3"><?php echo $order['order_id']; ?></td>
                                    <td class="p-3"><?php echo $order['name']; ?></td>
                                    <td class="p-3"><?php echo $order['date']; ?></td>
                                    <td class="p-3">$<?php echo $order['total_amount']; ?></td>
                                    <td class="p-3"><?php echo $order['status']; ?></td>
                                    <td class="p-3">
                                        <?php if ($role === 'administrator' || $role === 'sales personnel') { ?>
                                            <form action="edit_order.php" method="GET" class="inline-block">
                                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                <button type="submit" class="text-blue-500 hover:text-blue-700">Edit</button>
                                            </form>
                                            <form action="../actions/delete_order_action.php" method="POST" class="inline-block">
                                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this order?')" class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Order Details table -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Order Details</h3>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="p-3 text-left">Order Detail ID</th>
                                    <th class="p-3 text-left">Order ID</th>
                                    <th class="p-3 text-left">Product Name</th>
                                    <th class="p-3 text-left">Quantity</th>
                                    <th class="p-3 text-left">Price</th>
                                    <th class="p-3 text-left">Order Status</th>
                                    <?php if ($role === 'administrator' || $role === 'sales personnel') { ?>
                                        <th class="p-3 text-left">Actions</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_details as $detail) { ?>
                                    <tr class="border-t">
                                        <td class="p-3"><?php echo $detail['order_detail_id']; ?></td>
                                        <td class="p-3"><?php echo $detail['order_id']; ?></td>
                                        <td class="p-3"><?php echo $detail['pname']; ?></td>
                                        <td class="p-3">
                                            <div class="flex items-center space-x-2">
                                                <form action="../actions/update_qty_action.php" method="POST" class="inline">
                                                    <input type="hidden" name="order_detail_id" value="<?php echo $detail['order_detail_id']; ?>">
                                                    <button type="submit" name="action" value="increase" class="text-green-500 hover:text-green-700">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                </form>
                                                <?php echo $detail['qty']; ?>
                                                <form action="../actions/update_qty_action.php" method="POST" class="inline">
                                                    <input type="hidden" name="order_detail_id" value="<?php echo $detail['order_detail_id']; ?>">
                                                    <button type="submit" name="action" value="decrease" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="p-3"><?php echo $detail['price']; ?></td>
                                        <td class="p-3"><?php echo $detail['order_status']; ?></td>
                                        <td class="p-3 flex space-x-2">
                                            <?php if ($role === 'administrator' || $role === 'sales personnel') { ?>
                                                <form action="../actions/delete_order_detail_action.php" method="POST" class="inline-block">
                                                    <input type="hidden" name="order_detail_id" value="<?php echo $detail['order_detail_id']; ?>">
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this order detail?')" class="text-red-500 hover:text-red-700">Delete</button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>
</body>

</html>