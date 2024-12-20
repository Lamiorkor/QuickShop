<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../controllers/order_controller.php');

// Retrieve the order ID from the GET request
$order_id = $_GET['order_id'];

// Fetch the order details using the controller
$order = getOneOrderController($order_id);

// Extract order details
$customer_name = $order['name'];
$order_date = $order['date'];
$total_amt = $order['total_amount'];
$status = $order['status']; 

// Get user role from the session
$role = $_SESSION['user_role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
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
        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6">Edit Order</h2>

            <!-- Edit Order Form -->
            <form action="../actions/edit_order_action.php" method="POST" class="bg-white shadow-md rounded-lg p-8">
                <!-- Hidden Field for Order ID -->
                <input type="hidden" id="order_id" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">

                <!-- Customer Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Customer Name (Read Only):</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($customer_name); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>

                <!-- Total Amount -->
                <div class="mb-4">
                    <label for="total_amt" class="block text-gray-700 font-semibold mb-2">Total Amount:</label>
                    <input type="number" id="total_amt" name="total_amt" value="<?php echo htmlspecialchars($total_amt); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Status:</label>
                    <select id="status" name="status" class="block w-full border border-gray-300 rounded-lg p-2">
                        <option value="pending" <?php echo $status === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="completed" <?php echo $status === 'completed' ? 'selected' : ''; ?>>Completed</option>
                        <option value="collected" <?php echo $status === 'collected' ? 'selected' : ''; ?>>Collected</option>
                        <option value="cancelled" <?php echo $status === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-4 mt-6">
                    <!-- Update Button -->
                    <button type="submit" onclick="return confirm('Are you sure you want to update the order?')" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                        Update Order
                    </button>
                    <!-- Cancel Button -->
                    <button type="button" onclick="confirmCancel()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Cancel action confirmation
        function confirmCancel() {
            if (confirm('Are you sure you want to cancel?')) {
                window.location.href = 'manage_orders.php';
            }
        }
    </script>
</body>
</html>
