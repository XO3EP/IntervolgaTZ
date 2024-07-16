<?php
$conn = new mysqli("localhost", "root", "", "comments_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$comment = $_POST['comment'];

$stmt = $conn->prepare("INSERT INTO comments (username, comment) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $comment);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: index.php");
exit();

