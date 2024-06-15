<?php
header('Content-Type: application/json');

$servername = "ep-proud-pond-a4nsf6ut.us-east-1.pg.koyeb.app";
$db_username = "sam-adm";
$db_password = "4pHUJFiRQZk2";
$dbname = "koyebdb";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]);
    exit();
}

$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $members = [];
    while($row = $result->fetch_assoc()) {
        $members[] = $row;
    }
    echo json_encode(['success' => true, 'members' => $members]);
} else {
    echo json_encode(['success' => false, 'message' => "No members found"]);
}

$conn->close();
?>