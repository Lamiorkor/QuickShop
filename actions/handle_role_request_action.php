<?php
session_start();
require_once('../controllers/user_controller.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        // Approve the role change
        switch ($role) {
            case 'administrator':
                changeRoleToAdminController($user_id);
                deleteRoleRequestController($user_id); 
                break;
            case 'inventory manager':
                changeRoleToInvManController($user_id);
                deleteRoleRequestController($user_id); 
                break;
            case 'sales personnel':
                changeRoleToSalesPrsnlController($user_id);
                deleteRoleRequestController($user_id); 
                break;
            case 'customer':
                changeRoleToCustomerController($user_id);
                deleteRoleRequestController($user_id); 
                break;
        }
    } elseif ($action === 'deny') {
        // Deny the role change request and delete it
        deleteRoleRequestController($user_id); 
    }

    // Redirect back to manage_roles page
    header("Location: ../view/manage_roles.php?status=request_$action");
    exit();
}
?>
