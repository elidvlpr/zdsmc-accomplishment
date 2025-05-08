<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $_POST['id'] ?? '', 
        'name' => $_POST['name'] ?? '', 
        'date' => $_POST['date'] ?? '',
    ];

    try {
        $insertStmt = $db->prepare(
            "INSERT INTO `holidays` 
                 (`id`, `name`, `date`)
                 VALUES 
                 (:id, :name, :date)");
        $insertStmt->bindParam(':id', $data['id']);
        $insertStmt->bindParam(':name', $data['name']);
        $insertStmt->bindParam(':date', $data['date']);
        $insertStmt->execute();
        
        echo json_encode([
            'status' => 'success',
            'message' => 'New holiday added successfully!',
            'data' => $data,
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage(),
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method!',
    ]);
}