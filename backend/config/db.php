<?php
$host = "localhost";
$dbname = "hollowdata";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database connected!";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>