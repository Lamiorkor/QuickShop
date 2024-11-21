<?php
// require('../controllers/category_controller.php');
// $categories = getAllCategorysController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6">Add New Product</h2>

            <!-- Back Button  -->
            <div class="flex justify-between items-center mb-6">
                <!-- Back Button (Left side) with Icon -->
                <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-arrow-left mr-2"></i> Go Back
                </a>

                <!-- View All Products -->
                <a href="view_product.php" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                    View All Products
                </a>

               

            </div>

            <!-- Product Form -->
            <form action="../actions/add_product_action.php" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-8">
                
                <!-- Brand Field -->
                <!-- Title Field -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Title:</label>
                    <input type="text" id="title" name="title" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Price Field -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Description Field -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
                    <textarea id="description" name="description" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" rows="3" required></textarea>
                </div>

                <!-- Keywords Field -->
                <div class="mb-4">
                    <label for="keywords" class="block text-gray-700 font-semibold mb-2">Keywords:</label>
                    <input type="text" id="keywords" name="keywords" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Stock Field -->
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock Amount:</label>
                    <input type="number" id="stock" name="stock" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Image Upload Field -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Product Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center gap-4 mt-6">
                    <input type="submit" value="Submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
