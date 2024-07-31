<?php

$host = '127.0.0.1';
$db = 'tekup_db';
$user = 'root';
$charset = 'utf8mb4';


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    
    $pdo = new PDO($dsn, $user);

 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    
    echo "Connection failed: " . $e->getMessage();
}