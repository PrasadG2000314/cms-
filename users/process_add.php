<?php
require(__DIR__ . "/../includes/config.php");
require(__DIR__ . "/../includes/function.php");

$_POST["password"] = password_hash($_POST["username"], PASSWORD_DEFAULT);

if (createUser($_POST)) {
    header("Location:/cms/users/index.php");
} else {
    header("Location:/cms/users/add.php?error=Couldn't create user");
}
?>