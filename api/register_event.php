<?php
// api/register_event.php

header("Content-Type: application/json");

$pdo = require_once 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$user_id  = $data['user_id'] ?? null;
$event_id = $data['event_id'] ?? null;

if (!$user_id || !$event_id) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID and Event ID are required']);
    exit;
}

try {
    // Prevent duplicate registration
    $check = $pdo->prepare("SELECT id FROM registrations WHERE user_id = ? AND event_id = ?");
    $check->execute([$user_id, $event_id]);

    if ($check->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(['error' => 'User already registered for this event']);
        exit;
    }

    // Insert registration
    $stmt = $pdo->prepare("INSERT INTO registrations (user_id, event_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $event_id]);

    echo json_encode(['message' => 'Registered for event successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
