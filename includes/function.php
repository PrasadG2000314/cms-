<?php
class DB
{
    private static $connection;
    public static function getConnection()
    {
        if (!self::$connection) {
            $connectionString = "mysql:dbname=".DATABASE_NAME.";host=localhost";
            self::$connection = new PDO($connectionString, DATABASE_USERNAME, DATABASE_PASSWORD);
        }

        return self::$connection;
    }
    
}


function findUser($username){
   $pdo = DB::getConnection();

    $sql = "SELECT * FROM users WHERE username = :username";

    $statement = $pdo->prepare($sql);

    $executed = $statement->execute([
        ":username" => $username
    ]);

    if(!$executed){
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

    return $_SESSION["username"]  && $_SESSION["id"];


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
        var_dump(isset($details[$input]));
        strlen(trim($details[$input]));
        if(!isset($details[$input]) || strlen(($details[$input])) === 0){
            $errors[$input] = "$input cannot be empty";
        }
    }

    if(count($errors) !== 0){
        return [false, $errors];
    }

    return [true, $errors];
}

function returnPageError() {
    $errorString = "";

    if (isset($_GET["error"])) {
        if (is_array($_GET["error"])) {
            foreach ($_GET["error"] as $error) {
                $errorString = 
                    $errorString . "<p><span class='alert alert-danger'>{$error}</span></p>";
            }  
        } else {
            $error = $_GET["error"];
            $errorString = "<p><span class='alert alert-danger'>{$error}</span></p>";
        }
    }
    return $errorString;
}

function getPages(){
    
    $pdo = DB::getConnection();

    $sql = "SELECT pages.*, u1.username AS author, u2.username AS updater FROM pages
           INNER JOIN users u1 ON u1.id = pages.user_id
           INNER JOIN users u2 ON u2.id = pages.last_updated_by
           WHERE pages.published = 1";
    
    $result = $pdo->query($sql);

    return $result;
}

function createPage($data){
    $pdo = DB::getConnection();

    $sql = "INSERT INTO pages (title, body, published, user_id, last_updated_by) 
    VALUES (:title, :body, :published, :user_id, :last_updated_by)";

    $statement = $pdo->prepare($sql);

    $inserted = $statement->execute([
        ":title" => $data["title"],
        ":body" => $data["body"],
        ":published" => $data["published"],
        ":user_id" => $data["user_id"],
        ":last_updated_by" => $data["last_updated_by"]
    ]);

    

    return $inserted;
}

function editPage($id, $data){
    $pdo = DB::getConnection();

    $sql = "UPDATE pages SET title = :title, body = :body, published = :published, last_updated_by = :last_updated_by  
    WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $editted = $statement->execute([
        ":id" => $id,
        ":title" => $data["title"],
        ":body" => $data["body"],
        ":published" => $data["published"],
        ":last_updated_by" => $data["last_updated_by"]
        
    ]);

    return $editted;
}

function getPage($id){
    $pdo = DB::getConnection();

    $sql = "SELECT * FROM pages WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        ":id" => $id
    ]);

    $row = $statement->fetch();

    return $row;
}

function deletePost($id){
    $pdo = DB::getConnection();

    $sql = "DELETE FROM pages WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $deleted = $statement->execute([
        ":id" => $id
    ]);

    return $deleted;
}
    
function blockPage(){
    startSession();
    
    if(!isset($_SESSION["id"])){
        header("Location:/simple_phpcms/index.php?message=You don't have  access to that page.Please log in");
    }
}

function returnPageMessage() {
    $infoString = "";
    if (isset($_GET["message"])) {
        if (is_array($_GET["message"])) {
            foreach ($_GET["message"] as $message) {
                $infoString .= "<p><span class='alert alert-danger'>{$message}</span></p>";
            }  
        } else {
            $message = $_GET["message"];
            $infoString = "<p><span class='alert alert-danger'>{$message}</span></p>";
        }
    }

    return $infoString;
}

function getUnpublishedPages(){
    $pdo = DB::getConnection();

    $sql = "SELECT * FROM pages WHERE published = 0";

    $result = $pdo->query($sql);

    return $result;
}

function publishPage($id){
    $pdo = DB::getConnection();

    $sql = "UPDATE pages SET published = 1 WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $editted = $statement->execute([
        ":id" => $id
    ]);

    return $editted;
}

function createUser($data){
    $pdo = DB::getConnection();

    $sql = "INSERT INTO users (username, password, first_name, last_name) 
    VALUES (:username, :password, :first_name, :last_name)";

    $statement = $pdo->prepare($sql);

    $inserted = $statement->execute([
        ":username" => $data["username"],
        ":password" => $data["password"],
        ":first_name" => $data["first_name"],
        ":last_name" => $data["last_name"]
    ]);

    return $inserted;
}

function getUsers(){
    $pdo = DB::getConnection();

    $sql = "SELECT id, username, first_name, last_name FROM users";

    $result = $pdo->query($sql);

    return $result;
}

function getUser($id){
    $pdo = DB::getConnection();

    $sql = "SELECT * FROM users WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        ":id" => $id
    ]);

    $row = $statement->fetch();

    return $row;
}

function editUser($id, $data){
    $pdo = DB::getConnection();

    $sql = "UPDATE users SET username = :username, first_name = :first_name, last_name = :last_name WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $editted = $statement->execute([
        ":id" => $id,
        ":username" => $data["username"],
        ":first_name" => $data["first_name"],
        ":last_name" => $data["last_name"],
        
    ]);

    return $editted;
}

function editUserPassword($id, $data){
    $pdo = DB::getConnection();

    $sql = "UPDATE users SET password = :password WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $editted = $statement->execute([
        ":id" => $id,
        ":password" => $data["password"]
    ]);

    return $editted;
}

function deleteUser($id){
    $pdo = DB::getConnection();

    $sql = "DELETE FROM users WHERE id = :id";

    $statement = $pdo->prepare($sql);

    $deleted = $statement->execute([
        ":id" => $id
    ]);

    return $deleted;
}

function doValidation($details, $toBeValidated){
    $errors = [];

    foreach($toBeValidated as $input){
        if(!isset($details[$input]) || strlen(($details[$input])) === 0){
            $errors[$input] = "$input cannot be empty";
        }
    }

    if(count($errors) !== 0){
        return [false, $errors];
    }

    return [true, []];
}

?>  