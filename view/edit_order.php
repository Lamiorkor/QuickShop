<?php
require_once ('manage_orders.php'); // Assume this controller contains a function to get a product by ID

$order_id = $_GET['order_id'];

$order = getOneOrderController($order_id); 

$customer_name = $order['name'];
$order_date = $order['order_date'];
$total_amt = $order['total_amount'];
$status = $product['status'];

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
    <div class="flex h-screen bg-gray-100">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-800">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            </div>
        </div>

        <div>
            <h2>Scroll down to edit product</h2>
        </div>

        <!-- Main Content -->
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
                    <label for="stock" class="block text-gray-700 font-semibold mb-2">Quantity in Stock:</label>
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
    <!-- <script>
        // Redirect to product listing after successful update
        <?php //if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
        
        window.location.href = '../view/view_product.php';
        alert('Stock successfully updated! Redirecting to product list.');
        <?php //endif; ?>

        // Cancel action confirmation
        function confirmCancel() {
            if (confirm('Are you sure you want to cancel?')) {
                window.location.href = '../view/view_product.php';
            }
        }
    </script> -->
</body>
</html>
