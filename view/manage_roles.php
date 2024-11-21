<?php
require_once('../controllers/user_controller.php');
session_start();

if ($_SESSION['role'] !== 'Administrator') {
    header('Location: unauthorized.php');
    exit;
}

// Fetch users and roles
$users = getAllUsersController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Roles</title>
</head>
<body>
    <h1>Manage User Roles</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <form method="POST" action="update_role.php">
                            <select name="role">
                                <option value="Administrator">Administrator</option>
                                <option value="Sales Personnel">Sales Personnel</option>
                                <option value="Inventory Manager">Inventory Manager</option>
                                <option value="Customer">Customer</option>
                            </select>
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit">Update Role</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
