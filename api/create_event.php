<?php
// api/create_event.php

header("Content-Type: application/json");

$pdo = require_once 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$title       = trim($data['title'] ?? '');
$description = trim($data['description'] ?? '');
$location    = trim($data['location'] ?? '');
$event_date  = trim($data['event_date'] ?? '');
$created_by  = $data['created_by'] ?? null;

if (!$title || !$event_date || !$created_by) {
    http_response_code(400);
    echo json_encode(['error' => 'Title, event date, and creator ID are required']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO events (title, description, location, event_date, created_by) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $location, $event_date, $created_by]);

    echo json_encode(['message' => 'Event created successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
