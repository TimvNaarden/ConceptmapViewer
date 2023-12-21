<?php
header('Content-Type: application/json');

$positionsFilePath = 'positions.json'; // Adjust the path as needed

// Read positions from file
$positions = file_exists($positionsFilePath) ? json_decode(file_get_contents($positionsFilePath), true) : [];

// Handle GET request to retrieve positions
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($positions);
    exit();
}

// Handle POST request to update positions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);
    if ($requestData) {
        $positions = $requestData;
        file_put_contents($positionsFilePath, json_encode($positions));
        echo json_encode(['message' => 'Positions updated successfully.']);
        exit();
    }
}

// Default response for unsupported methods
echo json_encode(['error' => 'Unsupported method']);
?>
