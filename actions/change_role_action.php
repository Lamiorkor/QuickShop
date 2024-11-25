<?php
session_start();
require_once('../controllers/user_controller.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    // Change role based on the selected option
    switch ($new_role) {
        case 'administrator':
            changeRoleToAdminController($user_id);
            break;
        case 'inventory manager':
            changeRoleToInvManController($user_id);
            break;
        case 'sales personnel':
            changeRoleToSalesPrsnlController($user_id);
            break;
        case 'customer':
            changeRoleToCustomerController($user_id);
            break;
        default:
            $_SESSION['error'] = "Invalid role selected.";
            header("Location: ../view/manage_roles.php");
            exit();
    }

    // Redirect back with success status
    $_SESSION['success'] = "User role updated successfully.";
    header("Location: ../view/manage_roles.php");
    exit();
} else {
    $_SESSION['error'] = "Failed to update user role.";
    header("Location: ../view/manage_roles.php");
    exit();
}
?>
