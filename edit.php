<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $albumId = $_POST['album_id'];
    $newName = $_POST['new_name'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE albums SET name = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sii", $newName, $albumId, $userId);

    if ($stmt->execute()) {
        echo "Album updated!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
