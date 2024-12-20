<?php
session_start();
require_once ('../controllers/product_controller.php');

$product_id = $_GET['product_id'];

$product = getOneProductController($product_id); 

$product_name = $product['pname'];
$description = $product['description'];
$price = $product['price'];
$stock_qty = $product['stock_qty'];

$role = $_SESSION['user_role'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Container with full-screen flex layout -->
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

        <!-- Main Content Area -->
        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6">Edit Product</h2>

            <!-- Edit Stock Form -->
            <form action="../actions/edit_product_action.php" method="POST" class="bg-white shadow-md rounded-lg p-8">
                <!-- Hidden Field for Product ID -->
                <input type="hidden" id="product_id" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="pname" class="block text-gray-700 font-semibold mb-2">Product Name:</label>
                    <input type="text" id="pname" name="pname" value="<?php echo htmlspecialchars($product_name); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2 bg-gray-100">
                </div>

                <!-- Description Field -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
                    <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($description); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Price Field -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price:</label>
                    <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Stock Field -->
                <div class="mb-4">
                    <label for="stock_qty" class="block text-gray-700 font-semibold mb-2">Quantity in Stock:</label>
                    <input type="number" id="stock_qty" name="stock_qty" value="<?php echo htmlspecialchars($stock_qty); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2">
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-4 mt-6">
                    <!-- Update Button -->
                    <button type="submit" onclick="return confirm('Are you sure you want to update the product?')" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                        Update Product
                    </button>
                    <!-- Cancel Button -->
                    <button type="button" onclick="confirmCancel()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Cancel action confirmation
        function confirmCancel() {
            if (confirm('Are you sure you want to cancel?')) {
                window.location.href = 'manage_products.php';
            }
        }
    </script>
</body>
</html>
