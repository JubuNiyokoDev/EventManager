<?php
    // Database connection parameters
    $host = 'localhost'; // or '127.0.0.1'
    $dbname = 'eventmanager';
    $username = 'root';
    $password = '';

    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        // Set PDO to throw exceptions on error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "Connected successfully"."<br>";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
