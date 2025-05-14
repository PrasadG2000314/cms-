<?php
require_once __DIR__ . "/config.php";

var_dump(DATABASE_USERNAME);
var_dump(DATABASE_PASSWORD);

try {
    $dsn = "mysql:host=" . DATABASE_HOST . ";port=" . DATABASE_PORT . ";dbname=" . DATABASE_NAME;
    $pdo = new PDO($dsn, DATABASE_USERNAME, DATABASE_PASSWORD);
    echo "✅ Connected to database successfully!";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
?>
