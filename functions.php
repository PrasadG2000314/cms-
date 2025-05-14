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
        var_dump(isset($details[$input])); // Confirmed: no curly braces used, no changes needed
        strlen(trim($details[$input]));
        if(!isset($details[$input]) || strlen(trim($details[$input])) === 0){
            $errors[$input] = "$input cannot be empty"; // No changes needed here
        }
    }

    if(count($errors) !== 0){ 
     return  [false, $errors];
    }

    return [true, $errors];
}
function returnLoginError(){
    $errorString = "";  // Initialize $errorString to avoid "undefined variable" warning

    if(isset($_GET["error"])){
        if(is_array($_GET["error"])){
            foreach($_GET["error"] as $error){
                $errorString = $errorString . "<p><span class='label label-danger' >{$error}</span></p>";
            }
        }
    }
    else{
        $error = $_GET["error"];
        $errorString = "<p><span class='label label-danger' >" . $error . "</span></p>";
    }

    return $errorString; // Fixed return placement
}


function getPages(){
    $dsn = "mysql:host=" . DATABASE_HOST . ";port=" . DATABASE_PORT . ";dbname=" . DATABASE_NAME;
    $pdo = new PDO($dsn, DATABASE_USERNAME, DATABASE_PASSWORD);
    
    $sql = "SELECT id, title, body FROM pages";
    $statement = $pdo->prepare($sql);
    
    $executed = $statement->execute();
    
    if (!$executed) {
        print_r($statement->errorInfo());
        exit("An error occurred executing statement");
    }
    
    $result = $statement->fetchAll();
    return $result;
}

?>
