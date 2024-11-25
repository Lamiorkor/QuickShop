<?php
session_start();
$role = 'administrator';
$_SESSION['user_name'] = "Janet";
$_SESSION['user_email'] = "jboye@gmail.com";
$_SESSION['user_id'] = 1;
//$role = $_SESSION['user_role']; // Example role, modify based on session value
require_once('../controllers/user_controller.php');
require_once('../controllers/product_controller.php'); // Include the product controller
$users = getAllUsersController(); // Fetch all users for role management
$roleRequests = getAllRoleRequestsController(); // Fetch all role change requests
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Roles - Admin Panel</title>
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

        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Manage Roles</h2>
                    <div class="flex items-center">
                        <span class="mr-4"><?php echo $_SESSION['user_name']; ?></span>
                        <a href="../actions/logout_action.php" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </header>

            <!-- Roles Content -->
            <main class="p-6">
                <!-- Manage User Roles Table -->
                <h3 class="text-lg font-semibold mb-4">Manage User Roles and Permissions</h3>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-3 text-left">User ID</th>
                                <th class="p-3 text-left">Name</th>
                                <th class="p-3 text-left">Role</th>
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) { ?>
                                <tr class="border-t">
                                    <td class="p-3"><?php echo $user['user_id']; ?></td>
                                    <td class="p-3"><?php echo $user['name']; ?></td>
                                    <td class="p-3">
                                        <form action="../actions/change_role_action.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <select name="role" class="bg-gray-100 p-2 rounded">
                                                <option value="administrator" <?php echo $user['role'] === 'administrator' ? 'selected' : ''; ?>>Administrator</option>
                                                <option value="inventory manager" <?php echo $user['role'] === 'inventory manager' ? 'selected' : ''; ?>>Inventory Manager</option>
                                                <option value="sales personnel" <?php echo $user['role'] === 'sales personnel' ? 'selected' : ''; ?>>Sales Personnel</option>
                                                <option value="customer" <?php echo $user['role'] === 'customer' ? 'selected' : ''; ?>>Customer</option>
                                            </select>
                                    </td>
                                    <td class="p-3 flex items-center space-x-4">
                                        <!-- Update Button -->
                                        <button type="submit" name="action" value="approve" onclick="return confirm('Are you sure you want to update this user\'s role?')" class="text-blue-500 hover:text-blue-700">Update</button>
                                        </form>
                                        <!-- Delete Button -->
                                        <form action="../actions/delete_user_action.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <button type="submit" name="action" value="delete" onclick="return confirm('Are you sure you want to delete this user?')" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Role Change Requests Table -->
                <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                    <h3 class="text-lg font-semibold mb-4">Role Change Requests</h3>
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-3 text-left">User ID</th>
                                <th class="p-3 text-left">User Name</th>
                                <th class="p-3 text-left">Requested Role</th>
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roleRequests as $request) { ?>
                                <tr class="border-t">
                                    <td class="p-3"><?php echo $request['user_id']; ?></td>
                                    <td class="p-3"><?php echo $request['name']; ?></td>
                                    <td class="p-3"><?php echo $request['role_requested']; ?></td>
                                    <td class="p-3">
                                        <form action="../actions/handle_role_request_action.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="user_id" value="<?php echo $request['user_id']; ?>">
                                            <input type="hidden" name="role" value="<?php echo $request['role_requested']; ?>">
                                            <button type="submit" name="action" value="approve" onclick="return confirm('Are you sure you want to approve this role change?')" class="text-green-500">Approve</button>
                                        </form>
                                        <form action="../actions/handle_role_request_action.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="user_id" value="<?php echo $request['user_id']; ?>">
                                            <button type="submit" name="action" value="deny" onclick="return confirm('Are you sure you want to deny this role change?')" class="text-red-500">Deny</button>
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