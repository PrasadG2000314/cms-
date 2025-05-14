<?php
require(__DIR__ . "/../includes/config.php");
require(__DIR__ . "/../includes/function.php");
$id = $_POST["id"];

if(editUser($id, $_POST)){
    $user = getUser($id);
    $_SESSION["username"] = $user["username"];
    header("Location:/cms/users/edit.php?id={$id}");
} else {
    header("Location:/cms/users/edit.php?id={$id}&error=Couldn't edit user");
}
?>