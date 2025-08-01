<?php
// api/register.php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Get $pdo from db.php
$pdo = require_once 'db.php';

//Get request body
$data = json_decode(file_get_contents("php://input"), true);

$full_name = trim($data['full_name'] ?? '');
$email     = trim($data['email'] ?? '');
$phone     = trim($data['phone'] ?? '');
$password  = trim($data['password'] ?? '');

if (!$full_name || !$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Please fill in all required fields']);
    exit;
}

try {
    //Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(['error' => 'Email already registered']);
        exit;
    }

    //Insert user
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$full_name, $email, $phone, $hashedPassword]);

    echo json_encode(['message' => 'User registered successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
