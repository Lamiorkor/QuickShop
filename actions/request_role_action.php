<?php
session_start();
require_once('../controllers/user_controller.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['rolerequest'])) {
    $user_id = $_POST['user_id'];
    $role_requested = $_POST['rolerequest'];

    if (addRequestController($user_id, $role_requested)) {
        header("Location: ../view/home.php?status=request_submitted");
    } else {
        header("Location: ../view/home.php?status=request_failed");
    }
    exit();
}
?>
