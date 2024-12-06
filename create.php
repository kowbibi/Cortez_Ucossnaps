<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['album_name'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO albums (user_id, name) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $name);

    if ($stmt->execute()) {
        echo "Album created!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<form method="post">
    <input type="text" name="album_name" placeholder="Album Name" required />
    <button type="submit">Create Album</button>
</form>
