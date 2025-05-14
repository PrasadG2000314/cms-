<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/../includes/function.php");
blockPage();

$id = $_GET["id"];

if(publishPage($id)){
    header("Location:/cms/pages/unpublished.php");
} else {
    header("Location:/cms/pages/unpublished.php?message=Couldn't publish page");
}

?>