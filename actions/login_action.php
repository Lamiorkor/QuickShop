<?php

session_start();

include "../settings/db_class.php";

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $sql = "SELECT * FROM Seamstress WHERE email = '$email'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result)> 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['pid'];

            header("Location: ../admin/dashboard.php");
        } else {
            echo "Error: Incorrect password. Try again.";
            header("Location: ../login/login_and_register_view.php");
        }
    } else {
        echo "Error: User not found. Sign up to the platform";
        header("Location:../login/login_and_register_view.php");
    }
    $con->close();
} else {
    echo "Error: Login failed";
    header("Location: ../login/login_and_register_view.php");
}
?>
