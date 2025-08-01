<?php
// api/my_registrations.php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$pdo = require_once 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'] ?? null;

if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID is required']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT 
            e.id AS event_id,
            e.title,
            e.description,
            e.location,
            e.event_date,
            r.registered_at
        FROM registrations r
        INNER JOIN events e ON r.event_id = e.id
        WHERE r.user_id = ?
        ORDER BY e.event_date DESC
    ");
    $stmt->execute([$user_id]);

    $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'registrations' => $registrations
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
