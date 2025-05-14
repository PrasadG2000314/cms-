<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/../includes/function.php");

$id = $_GET["id"];
startSession();

if ($_SESSION["id"] == $id) {
    header("Location:/simple_phpcms/users/index.php?error=You can't delete your own account");
}

if (deleteUser($id)) {
    header("Location:/cms/users");
} 
else {
    header("Location:/cms/users?error=Couldn't delete user");
}
?>