<?php
include "../settings/connection.php";

if (isset($_POST['signup'])) {

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $shop_name = mysqli_real_escape_string($con, $_POST['shop_name']);
    $shop_location = mysqli_real_escape_string($con, $_POST['shop_location']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Seamstress (fname, lname, email, phone_number, shop_name, shop_location, password) 
        VALUES ('$fname', '$lname', '$email', '$number', '$shop_name', '$shop_location', '$hashed_password')";

    if (mysqli_query($con, $sql)) {
        header("Location: ../login/login_and_register_view.php");
        exit();
    } else {
        echo "Error. Please try registering again.";
        header("Location: ../login/login_and_register_view.php");
        exit();
    }

    $con->close();
}
