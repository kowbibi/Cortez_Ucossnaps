<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $albumId = $_POST['album_id'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM albums WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $albumId, $userId);

    if ($stmt->execute()) {
        echo "Album deleted!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
