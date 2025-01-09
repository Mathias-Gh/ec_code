<?php

try {
    $dsn = "mysql:host=127.0.0.1;port=8889;dbname=ec_code";
    $username = "root";
    $password = "root";

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to the database!";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
