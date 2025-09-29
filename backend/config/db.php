<?php
$host = "localhost";      // of 127.0.0.1
$dbname = "hollowdata"; // jouw database naam
$username = "root";       // standaard in XAMPP/MAMP
$password = "";           // standaard leeg in XAMPP

try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database verbinding mislukt: " . $e->getMessage());
    }