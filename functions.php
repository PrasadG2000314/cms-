<?php
require_once("config.php");

function findUser($username) {
    $dsn = "mysql:host=" . DATABASE_HOST . ";port=" . DATABASE_PORT . ";dbname=" . DATABASE_NAME;
    $pdo = new PDO($dsn, DATABASE_USERNAME, DATABASE_PASSWORD);
    
    $sql = "SELECT * FROM users WHERE username = :username";
    $statement = $pdo->prepare($sql);
    
    $executed = $statement->execute([
        "username" => $username // ← FIXED: use correct variable
    ]);
    
    if (!$executed) {
        print_r($statement->errorInfo());
        exit("An error occurred executing statement");
    }
    
    $result = $statement->fetchAll();
    return $result;
}

function loginUser($user){
    startSession();
    $_SESSION["id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    return $_SESSION["username"] && $_SESSION["id"];
}

function startSession(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
}


function validateLogin($details){
    $toBeValidated = ["username", "password"];
    $errors = [];

    foreach($toBeValidated as $input){
        if(!isset($details[$input]) || strlen(trim($details[$input])) === 0){
            $errors[$input] = "$input cannot be empty";
        }
    }

    if(count($errors) !== 0){
        [false, $errors];
    }

    return [true, $errors];
}
?>
