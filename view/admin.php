<?php
session_start();
$role = $_SESSION['user_role'];
require_once('../controllers/product_controller.php');
require_once('../controllers/order_controller.php');

$totalProducts = getTotalProductsCountController();
$totalOrders = getTotalOrdersCount();
$totalRevenue = getTotalOrderRevenueController();
// $recentOrders = getRecentOrders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Database Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Admin Dashboard</h2>
                    <div class="flex items-center">
                        <span class="mr-4"><?php echo $_SESSION['user_name']; ?></span>
                        <a href="../actions/logout_action.php" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h4 class="text-sm text-gray-500">Total Products</h4>
                        <h3 class="text-2xl font-bold"><?php echo $totalProducts; ?></h3>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h4 class="text-sm text-gray-500">Total Orders</h4>
                        <h3 class="text-2xl font-bold"><?php echo $totalOrders; ?></h3>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h4 class="text-sm text-gray-500">Total Revenue</h4>
                        <h3 class="text-2xl font-bold">$<?php echo $totalRevenue; ?></h3>
                    </div>
                </div>


                <!-- Audit Logs -->
                <section>
                    <h3 class="text-lg font-semibold mb-4">System Logs</h3>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <p>Feature to display and manage system logs and alerts for database security.</p>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>
</html>
