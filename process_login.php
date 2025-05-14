<?php
require_once("config.php");
require_once("functions.php");




$username = $_POST["username"];
$password = $_POST["password"];

$validation = validateLogin($_POST);

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
    echo "User is logged in";
}
else {
    echo "Couldn't log in user";
}

?>