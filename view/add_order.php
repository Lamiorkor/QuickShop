<?php
session_start();
require_once ('../controllers/user_controller.php');

$customers = getAllCustomersController();

$role = $_SESSION['user_role'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                <?php if ($role === 'administrator' || $role === 'sales personnel') { ?>
                    <a href="manage_orders.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                        <i class="fas fa-shopping-cart mr-3"></i> Orders
                    </a>
                <?php } ?>
                <?php if ($role === 'administrator' || $role === 'inventory manager') { ?>
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
        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6">Add New Order</h2>

            <!-- Back Button  -->
            <div class="flex justify-between items-center mb-6">
                <!-- Back Button (Left side) with Icon -->
                <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-arrow-left mr-2"></i> Go Back
                </a>

                <!-- View All Products -->
                <a href="view_orders.php" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                    View All Orders
                </a>

               

            </div>

            <!-- Order Form -->
            <form action="../actions/add_order_action.php" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-8">
                
                <!-- Customer Field -->
                <div class="mb-4">
                    <label for="user_id" class="block text-gray-700 font-semibold mb-2">Customer:</label>
                    <select name="user_id" class="block text-gray-700 font-semibold mb-2">
                        <?php foreach ($customers as $customer) { ?>
                            <option value="<?php echo $customer['user_id'];?>"><?php echo $customer['name'];?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Products Ordered Field -->
                <!-- <div class="mb-4">
                    <label for="order_date" class="block text-gray-700 font-semibold mb-2">Date Ordered:</label>
                    <date id="order_date" name="order_date" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" rows="3" required></textarea>
                </div> -->

                <!-- Total Amount Field -->
                <div class="mb-4">
                    <label for="total_amount" class="block text-gray-700 font-semibold mb-2">Total Amount:</label>
                    <input type="number" id="total_amount" name="total_amount" step="0.01" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center gap-4 mt-6">
                    <input type="submit" value="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
