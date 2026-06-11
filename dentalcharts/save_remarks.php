<?php
header('Content-Type: application/json');

$tooth = $_POST['tooth'];
$image = $_POST['image'];
$clientid = (int) $_POST['clientid'];
$remarks = $_POST['remarks'];

if (strpos($image, 'data:image/png;base64,') === 0) {
    $image = substr($image, strlen('data:image/png;base64,'));
}
$image = base64_decode($image);

// $conn = new mysqli("localhost", "root", "", "sam_db");
$conn = new mysqli("localhost", "victoria_user", "ZWUhzwcEI+){7&yL", "victoria_system");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => $conn->connect_error]);
    exit;
}

// Step 1: Check if entry exists
$checkSql = "SELECT 1 FROM toothremarks WHERE clientid = ? AND tooth = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("is", $clientid, $tooth);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // Exists → UPDATE
    $sql = "UPDATE toothremarks SET image = ?, remarks = ? WHERE clientid = ? AND tooth = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("bsis", $imageParam, $remarks, $clientid, $tooth);
    $imageParam = $image;
    $stmt->send_long_data(0, $image);
} else {
    // Doesn't exist → INSERT
    $sql = "INSERT INTO toothremarks (tooth, image, clientid,remarks) VALUES (?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sbis", $tooth, $imageParam, $clientid, $remarks);
    $imageParam = $image;
    $stmt->send_long_data(1, $image);
}

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$checkStmt->close();
$conn->close();
?>