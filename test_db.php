<?php
// Test database connection
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;port=8889;dbname=event_registration",
        'root',
        'root'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection successful!\n";
    
    // Test if tables exist
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables found: " . implode(', ', $tables) . "\n";
    
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
    echo "Please ensure MAMP is running and the database 'event_registration' exists\n";
}
?>
