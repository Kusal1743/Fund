<?php
include 'config.php';

header('Content-Type: application/json');

try {
    $stmt = $conn->query("SELECT userid, username, email FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'users' => $users
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch users: ' . $e->getMessage()
    ]);
}