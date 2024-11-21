<?php
// require('../controllers/product_controller.php'); // Assume this controller contains a function to get a product by ID


    
// $product_id = $_GET['product_id'];
// $product = getProductByIdController($product_id); 




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Stock</title>
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
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6">Edit Product Stock</h2>

            <!-- Edit Stock Form -->
            <form action="../actions/update_stock_action.php" method="post" class="bg-white shadow-md rounded-lg p-8">
                <!-- Hidden Field for Product ID -->
                <input type="hidden" id="product_id" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

                <!-- Product Title (Read-Only) -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Product Title:</label>
                    <input type="text" id="title" value="<?php echo htmlspecialchars($product['title']); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>

                <!-- Stock Field -->
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock Amount:</label>
                    <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock_amount']); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2" required>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-4 mt-6">
                    <!-- Update Button -->
                    <button type="submit" onclick="return confirm('Are you sure you want to update the stock?')" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                        Update Stock
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
        // Redirect to product listing after successful update
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
        
        window.location.href = '../view/view_product.php';
        alert('Stock successfully updated! Redirecting to product list.');
        <?php endif; ?>

        // Cancel action confirmation
        function confirmCancel() {
            if (confirm('Are you sure you want to cancel?')) {
                window.location.href = '../view/view_product.php';
            }
        }
    </script>
</body>
</html>
