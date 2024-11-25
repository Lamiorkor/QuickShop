<?php
include ('../controllers/user_controller.php');

// Get the service ID from the form submission
if (isset($_POST['user_id'])) {
    $userID = $_POST['user_id'];

     // Call deleteUserController
     $user = deleteUserController($userID);

    // Instantiate and delete the user
    if ($user !== false) {
        // Redirect to product page with success message
        echo "User deleted successfully!";
        header("Location:../view/manage_roles.php");
        exit();
    } else {
        echo "Error deleting user";
        header("Location:../view/manage_roles.php");
        exit();
    }
}

?>