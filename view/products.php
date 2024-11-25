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
    <title>View Products - Customer</title>
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
                    <a href="edit_customer.php" class="text-gray-300 hover:text-white">
                        <i class="fas fa-user-edit"></i> Update Your Account
                    </a>
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
                    <h2 class="text-xl font-semibold">View Products</h2>
                    <div class="flex items-center">
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <span class="text-black-300">Hello, <?php echo $_SESSION['user_name']; ?>!</span>
                            <a href="cart.php" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-shopping-cart"></i> View Cart
                            </a>
                            <?php //else: 
                            ?>
                            <!-- <a href="login_and_register.php" class="text-black-300 hover:text-gray">Login/Register</a> -->
                        <?php endif; ?>
                    </div>
                </div>
            </header>

            <!-- Products Content -->
            <main class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Product List</h3>
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
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr class="border-t">
                                    <td class="p-3"><?php echo $product['product_id']; ?></td>
                                    <td class="p-3"><?php echo $product['pname']; ?></td>
                                    <td class="p-3"><?php echo $product['description']; ?></td>
                                    <td class="p-3"><?php echo $product['price']; ?></td>
                                    <td class="p-3"><?php echo $product['stock_qty']; ?></td>
                                    <td class="p-3">
                                        <form action="../actions/add_to_cart_action.php" method="POST">
                                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product['product_id']; ?>">
                                            <button type="submit" class="text-green-500">Add to Cart</button>
                                        </form>
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