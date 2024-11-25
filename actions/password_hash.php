<?php

$Janetpassword = "J@netB123";
$PJpassword = "jisthebesT@098";
$favpassword = "Favoured!234";
$jimPassword = "casamigo@249824";
$hash = password_hash($jimPassword, PASSWORD_BCRYPT);
var_dump($hash);
exit();
$verify = password_verify($jimPassword, "$2y$10$wWxJ/cUdIDL3lip1U0PD4OKn1YsyddYZujwJ0hInHUTcrQbfD1LY6");
var_dump($verify);

$hashhh = "$2y$10$l4mg3DoTADh0G6F3.BuFbe95WHdlVI5zyzlAF5V6zT5HhwnUFqpQO";
//var_dump($hash);
exit();
?>