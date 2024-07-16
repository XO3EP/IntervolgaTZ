<?php
$conn = new mysqli("localhost", "root", "", "comments_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("UPDATE comments SET username = ?, comment = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $comment, $id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: index.php");
    exit();
} else {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT username, comment FROM comments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($username, $comment);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать комментарий</title>
</head>
<body>
    <h1>Редактировать комментарий</h1>
    <form action="edit_comment.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <label for="username">Имя:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br><br>
        <label for="comment">Комментарий:</label>
        <textarea id="comment" name="comment" required><?php echo htmlspecialchars($comment); ?></textarea><br><br>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>
