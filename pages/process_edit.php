<?php require_once(__DIR__ . "/../includes/config.php"); ?>
<?php require_once(__DIR__ . "/../includes/function.php"); ?>
<?php blockPage(); ?>
<?php

startSession();
$_POST['last_updated_by'] = $_SESSION["id"];

$toBeValidated = ['title', 'body', 'user_id', 'last_updated_by'];
$validation = doValidation($_POST, $toBeValidated);

if(!$validation[0]){
    $error = $validation[1];
    $error = http_build_query(array('error' => $error));
    header("Location:/cms/pages/add.php?".$error);
    exit;
} 

$id = $_POST["id"];

if(isset($_POST["published"])){
    $_POST["published"] = 1;
} else {
    $_POST["published"] = 0;
}

if(editPage($id, $_POST)){
    header("Location:/cms/pages/edit?id={$id}");
} else {
    header("Location:/cms/pages/edit/id={$id}&error=Couldn't edit page");
}

?>