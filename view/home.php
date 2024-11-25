<?php
session_start();
require_once('../controllers/product_controller.php');
$products = getProductsController(); // Fetch all products
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="home.php" class="text-white text-2xl font-bold">QuickShop</a>
        <div class="flex items-center space-x-4">
            <a href="home.php" class="text-gray-300 hover:text-white">Home</a>
            <a href="products.php" class="text-gray-300 hover:text-white">Products</a>
            <a href="view_orders.php" class="text-gray-300 hover:text-white">Orders</a>
            <?php if ($user_name): ?>
                <span class="text-gray-300">Hello, <?php echo $user_name; ?>!</span>
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


    <!-- Hero Section -->
    <header class="bg-cover bg-center h-96" style="background-image: url('hero-image.jpg');">
        <div class="bg-black bg-opacity-50 h-full flex items-center justify-center text-center">
            <div>
                <h1 class="text-5xl font-bold text-white">Discover Unique Products</h1>
                <p class="text-lg text-gray-300 mt-4">Shop the latest items and enjoy exclusive deals!</p>
                <a href="#products" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded mt-4 inline-block">Shop Now</a>
            </div>
        </div>
    </header>

    <!-- Product Section -->
    <section id="products" class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-semibold mb-6 text-center">Featured Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold"><?php echo $product['pname']; ?></h3>
                            <p class="text-gray-600"><?php echo $product['description']; ?></p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-lg font-bold">$<?php echo number_format($product['price'], 2); ?></span>
                                <a href="products.php?id=<?php echo $product['product_id']; ?>" class="bg-blue-500 text-white py-1 px-4 rounded hover:bg-blue-700">View</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Role Change Request Form -->
    <section class="bg-white p-6 rounded-lg shadow-md mt-6 container mx-auto px-6">
        <h3 class="text-lg font-semibold mb-4">Request Role Change</h3>
        <form action="../actions/request_role_action.php" method="POST">
            <label for="rolerequest" class="block text-sm font-medium text-gray-700">Request New Role</label>
            <select name="rolerequest" id="rolerequest" class="mt-1 block w-full p-2 border rounded">
                <option value="administrator">Administrator</option>
                <option value="inventory manager">Inventory Manager</option>
                <option value="sales personnel">Sales Personnel</option>
                <option value="customer">Customer</option>
            </select>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Submit Request</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-6">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <p>&copy; <?php echo date("Y"); ?> QuickShop. All rights reserved.</p>
            <div class="space-x-4">
                <a href="https://www.facebook.com" class="text-gray-300 hover:text-white">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.twitter.com" class="text-gray-300 hover:text-white">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.instagram.com" class="text-gray-300 hover:text-white">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>
