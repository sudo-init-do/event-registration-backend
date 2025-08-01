<?php
// api/db.php

require_once __DIR__ . '/../config/config.php';

try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;port=8889;dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
