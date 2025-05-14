<?php require_once(__DIR__ . "/../includes/config.php"); ?>
<?php require_once(__DIR__ . "/../includes/function.php"); ?>
<?php
$id=$_GET["id"];

if(deletePost($id)){
    header("Location:/cms/pages/index.php");
} else {
    header("Location:/cms/pages/index.php?error=Couldn't delete page");
}

?>