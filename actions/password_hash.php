<?php

$password = "J@netB123";
$hash = password_hash($password, PASSWORD_DEFAULT);
var_dump($hash);
exit();
?>