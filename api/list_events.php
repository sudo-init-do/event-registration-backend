<?php
// api/list_events.php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

$pdo = require_once 'db.php';

try {
    $stmt = $pdo->query("SELECT e.id, e.title, e.description, e.location, e.event_date, e.created_at, u.full_name AS created_by
                         FROM events e
                         LEFT JOIN users u ON e.created_by = u.id
                         ORDER BY e.event_date DESC");

    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'events' => $events
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
