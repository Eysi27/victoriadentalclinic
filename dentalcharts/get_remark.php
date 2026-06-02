<?php
$tooth = $_GET['tooth'];
$clientId = (int) $_GET['clientid'];

// $conn = new mysqli("localhost", "root", "", "sam_db");
$conn = new mysqli("localhost", "smilesan_admin", "G[aZ=F,G*~OT", "smilesan_official");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT remarks FROM toothremarks WHERE tooth = ? AND clientid = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    // Show detailed SQL error
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("si", $tooth, $clientId);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo json_encode(['remark' => $row['remarks'] ?? '']);

$stmt->close();
$conn->close();
?>