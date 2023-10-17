<?php

$adminPassword = 'admin123';

$hashedAdminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

echo $hashedAdminPassword;
?>
