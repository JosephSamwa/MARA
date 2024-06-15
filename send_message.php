<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    $servername = "ep-proud-pond-a4nsf6ut.us-east-1.pg.koyeb.app";
    $db_username = "sam-adm";
    $db_password = "4pHUJFiRQZk2";
    $dbname = "koyebdb";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $message);

    if ($stmt->execute() === TRUE) {
        echo json_encode(['success' => true, 'message' => "Message sent successfully!"]);
    } else {
        echo json_encode(['success' => false, 'message' => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>