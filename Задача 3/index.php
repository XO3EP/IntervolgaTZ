<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Комментарии</title>
</head>
<body>
    <h1>Комментарии</h1>
    <form action="add_comment.php" method="post">
        <label for="username">Имя:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="comment">Комментарий:</label>
        <textarea id="comment" name="comment" required></textarea><br><br>
        <input type="submit" value="Добавить комментарий">
    </form>
    <h2>Список комментариев:</h2>
    <ul>
        <?php
        $conn = new mysqli("localhost", "root", "", "comments_db");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT id, username, comment, created_at FROM comments ORDER BY created_at DESC");
        $stmt->execute();
        $stmt->bind_result($id, $username, $comment, $created_at);
        while ($stmt->fetch()) {
            echo "<li><strong>" . htmlspecialchars($username) . ":</strong> " . htmlspecialchars($comment) . " <em>(" . $created_at . ")</em> ";
            echo "<a href='edit_comment.php?id=$id'>Изменить</a> ";
            echo "<a href='delete_comment.php?id=$id'>Удалить</a></li>";
        }
        $stmt->close();
        $conn->close();
        ?>
    </ul>
</body>
</html>
