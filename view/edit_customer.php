<?php
session_start();
require_once('../controllers/user_controller.php');

// Fetch user details (assuming a function to get user data exists)
$user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session
$user = getUserByIdController($user_id); // Fetch user details using the ID

if (!$user) {
    // Redirect or show error if user not found
    header("Location: login_and_register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Your Account</title>
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
                <a href="../actions/logout_action.php" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Edit Customer Section -->
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6 text-center">Edit Your Account</h2>

        <!-- Edit Customer Form -->
        <form action="../actions/edit_customer_action.php" method="POST" class="bg-white shadow-md rounded-lg p-8 max-w-lg mx-auto">
            <!-- Hidden Field for User ID -->
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
            
            <!-- Full Name -->
            <div class="mb-4">
                <label for="full_name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" 
                       class="form-control block w-full border border-gray-300 rounded-lg p-2 bg-gray-100">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" 
                       class="form-control block w-full border border-gray-300 rounded-lg p-2">
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password:</label>
                <input type="text" id="password" name="password" value="<?php echo 'Type a New Password Here, Make sure you  remember!!'; ?>" 
                       class="form-control block w-full border border-gray-300 rounded-lg p-2">
            </div>

            
            <!-- Role (Read-Only) -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-semibold mb-2">Role(You can't change this):</label>
                <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" 
                       class="form-control block w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
            </div>

            <!-- Buttons -->
            <div class="flex justify-center gap-4 mt-6">
                <!-- Update Button -->
                <button type="submit" onclick="return confirm('Are you sure you want to update your account?')" 
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                    Update Account
                </button>
                <!-- Cancel Button -->
                <button type="button" onclick="window.location.href='home.php'" 
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                    Cancel
                </button>
            </div>
        </form>
    </div>

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
