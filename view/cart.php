<?php
session_start();
require_once('../controllers/cart_controller.php'); 

$user_id = $_SESSION['user_id'];
$cart_items = getCartItemsController($user_id); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cart - Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <!-- Main Content with padding to account for fixed navbar -->
    <div class="flex pt-16 h-screen">
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Manage Cart</h2>
                </div>
            </header>

            <!-- Cart Content -->
            <main class="p-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Items in Your Cart</h3>
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-3 text-left">Product Name</th>
                                <th class="p-3 text-left">Quantity</th>
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($cart_items): ?>
                                <?php foreach ($cart_items as $cart_item): ?>
                                    <tr class="border-t">
                                        <td class="p-3"><?php echo $cart_item['pname']; ?></td>
                                        <td class="p-3">
                                            <div class="flex items-center space-x-2">
                                                <form action="../actions/update_cart_action.php" method="POST" class="inline">
                                                    <input type="hidden" name="product_id" value="<?php echo $cart_item['product_id']; ?>">
                                                    <button type="submit" name="action" value="increase" class="text-green-500 hover:text-green-700">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                </form>
                                                <span><?php echo $cart_item['qty']; ?></span>
                                                <form action="../actions/update_cart_action.php" method="POST" class="inline">
                                                    <input type="hidden" name="product_id" value="<?php echo $cart_item['product_id']; ?>">
                                                    <button type="submit" name="action" value="decrease" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="p-3"><?php echo $cart_item['price']; ?></td>
                                        <td class="p-3">
                                            <form action="../actions/delete_from_cart_action.php" method="POST">
                                                <input type="hidden" name="product_id" value="<?php echo $cart_item['product_id']; ?>">
                                                <button type="submit" name="action" value="delete" class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="p-3 text-center text-gray-500">Your cart is empty.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Proceed to Checkout Button -->
                    <div class="mt-6 text-right">
                        <form action="../actions/add_order_action.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                            <input type="hidden" name="total_amount" value="<?php echo getCartItemsCostController($user_id);?>">
                            <button type="submit" name="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-700">
                                Proceed to Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
