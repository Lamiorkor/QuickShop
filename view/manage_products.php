<?php
session_start();
$role = $_SESSION['user_role'];
require_once('../controllers/product_controller.php');
$products = getProductsController(); // Fetch all products

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Admin Panel</title>
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
                <?php if ($role === 'administrator') { ?>
                    <a href="admin.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                <?php } ?>

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
                    <h2 class="text-xl font-semibold">Manage Products</h2>
                    <div class="flex items-center">
                        <span class="mr-4"><?php echo $_SESSION['user_name']; ?></span>
                        <a href="../actions/logout_action.php" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </header>

            <!-- Products Content -->
            <main class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Product List</h3>
                    <?php if ($role === 'administrator' || $role === 'inventory manager') { ?>
                        <a href="add_product.php" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded shadow">
                            <i class="fas fa-plus mr-2"></i> Add New Product
                        </a>
                    <?php } ?>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-3 text-left">Product ID</th>
                                <th class="p-3 text-left">Name</th>
                                <th class="p-3 text-left">Description</th>
                                <th class="p-3 text-left">Price</th>
                                <th class="p-3 text-left">Stock Quantity</th>
                                <?php if ($role === 'administrator' || $role === 'inventory manager') { ?>
                                    <th class="p-3 text-left">Actions</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr class="border-t">
                                    <td class="p-3"><?php echo $product['product_id']; ?></td>
                                    <td class="p-3"><?php echo $product['pname']; ?></td>
                                    <td class="p-3"><?php echo $product['description']; ?></td>
                                    <td class="p-3">$<?php echo $product['price']; ?></td>
                                    <td class="p-3"><?php echo $product['stock_qty']; ?></td>
                                    <td class="p-3 flex items-center space-x-4">
                                        <?php if ($role === 'administrator' || $role === 'inventory_manager') { ?>
                                            <!-- Edit Button -->
                                            <form action="edit_product.php" method="GET" class="inline-block">
                                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                                <button type="submit" class="text-blue-500 hover:text-blue-700">Edit</button>
                                            </form>
                                            <!-- Delete Button -->
                                            <form action="../actions/delete_product_action.php" method="POST" class="inline-block">
                                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>