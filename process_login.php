<?php
require_once("/includes/config.php");
require_once(__DIR__."/includes/function.php");




$username = $_POST["username"];
$password = $_POST["password"];

$validation = validateLogin($_POST);

var_dump($validation);
exit;

if(!$validation[0]){
    $error = http_build_query(array("error" => $validation[1]));
    header("Location: /index.php?".$error);
    exit;
}

$user = findUser($username);

if(count($user) > 1){
    exit("You have duplicate username in your table");
}

//var_dump($user);
//echo password_verify($password, $user[0]["password"]);
//exit;

if(count($user) === 0 || !password_verify($password, $user[0]["password"])){
    echo $user[0]["password"];
    exit("Username or password is invalid");
}

$user = $user[0];

if(loginUser($user)){
    header ("Location: /pages/index.php");
}
else {
    echo "Couldn't log in user";
}

?>