<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $albumId = $_POST['album_id'];
    $photo = $_FILES['photo'];
    $uploadDir = "../uploads/";
    $photoPath = $uploadDir . basename($photo["name"]);

    if (move_uploaded_file($photo["tmp_name"], $photoPath)) {
        $stmt = $conn->prepare("INSERT INTO photos (album_id, photo_path) VALUES (?, ?)");
        $stmt->bind_param("is", $albumId, $photoPath);
        if ($stmt->execute()) {
            echo "Photo uploaded!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload photo.";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="album_id" value="1" />
    <input type="file" name="photo" required />
    <button type="submit">Upload Photo</button>
</form>
