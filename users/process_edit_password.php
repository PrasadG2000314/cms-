<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/../includes/function.php");
blockPage();
startSession();

$id = $_SESSION["id"];
$old_password = $_POST["old_password"];
$new_password = $_POST["new_password"];
$confirm_password = $_POST["confirm_password"];

$error = '';

$user = getUser($id);

if($newPassword != $confirmPassword){
    $error = 'New password and confirm password do not match.';
} 
elseif(!password_verify($oldPassword, $user["password"])){
    $error = 'Old password does not exist.';
}
elseif(password_verify($newPassword, $user["password"])){
    $error = 'You cannot use the same password.';
}
elseif(strlen(trim($newPassword)) == 0 || strlen(trim($confirmPassword)) === 0){
    $error = 'Password cannot be empty.';
}

if(strlen($error) > 0){
    header("Location:/cms/users/edit.php?id={$id}&error={$error}");
}
else{
    $_POST["password"] = password_hash($newPassword, PASSWORD_DEFAULT);
    if(editUserPassword($id, $_POST)){
        header("Location:/cms/users/edit.php?id={$id}");
    } else { 
       header("Location:/cms/users/edit.php?id={$id}&error=Couldn't edit password");
    }
}


?>

