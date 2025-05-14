<?php require_once(__DIR__ . "/../includes/config.php"); ?>
<?php require_once(__DIR__ . "/../includes/function.php"); ?>
<?php blockPage(); ?>
<?php

startSession();
$_POST['user_id'] = $_SESSION["id"];
$_POST['last_updated_by'] = $_SESSION["id"];

$toBeValidated = ['title', 'body', 'user_id', 'last_updated_by'];
$validation = doValidation($_POST, $toBeValidated);

if(!$validation[0]){
    $error = $validation[1];
    $error = http_build_query(array('error' => $error));
    header("Location:/cms/pages/add.php?".$error);
    exit;
} 

if(isset($_POST["published"])){
    $_POST["published"] = 1;
} else {
    $_POST["published"] = 0;
}

if(createPage($_POST)){
    header("Location:/cms/pages/index.php");
} else {
    header("Location:/cms/pages/add.php?error=Couldn't create page");
}
?>