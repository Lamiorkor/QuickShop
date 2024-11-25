<?php

$password = "J@netB123";
$password2 = "jisthebesT@098";
$hash = password_hash($password2, PASSWORD_DEFAULT);
var_dump($hash);
exit();
?>