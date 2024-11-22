<?php
require_once ('../controllers/user_controller.php');

$customers = getAllCustomersController();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
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
            <h2 class="text-2xl font-semibold mb-6">Add New Order</h2>

            <!-- Back Button  -->
            <div class="flex justify-between items-center mb-6">
                <!-- Back Button (Left side) with Icon -->
                <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-arrow-left mr-2"></i> Go Back
                </a>

                <!-- View All Products -->
                <a href="view_orders.php" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                    View All Orders
                </a>

               

            </div>

            <!-- Order Form -->
            <form action="../actions/add_order_action.php" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-8">
                
                <!-- Customer Field -->
                <div class="mb-4">
                    <label for="customer" class="block text-gray-700 font-semibold mb-2">Customer:</label>
                    <select name="customer" class="block text-gray-700 font-semibold mb-2">
                        <?php foreach ($customers as $customer) { ?>
                            <option value="<?php echo $customer['user_id'];?>"><?php echo $customer['name'];?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Products Ordered Field -->
                <div class="mb-4">
                    <label for="order_date" class="block text-gray-700 font-semibold mb-2">Date Ordered:</label>
                    <date id="order_date" name="order_date" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" rows="3" required></textarea>
                </div>

                <!-- Total Amount Field -->
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 font-semibold mb-2">Total Amount:</label>
                    <input type="number" id="amount" name="amount" step="0.01" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center gap-4 mt-6">
                    <input type="submit" value="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
