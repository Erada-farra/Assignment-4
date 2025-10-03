<?php
$connection = new mysqli("localhost", "root", "", "Assignment4");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (!isset($_GET['id'])) {
    die("No news ID provided.");
}
$news_id = intval($_GET['id']);
$sql = "SELECT news.*, categories.name AS category_name 
        FROM news 
        LEFT JOIN categories ON news.category_id = categories.id 
        WHERE news.id=$news_id";
$result = $connection->query($sql);

if ($result->num_rows == 0) {
    die("News not found.");
}
$news = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News Details</title>
</head>
<body>
    <h2>News Details</h2>

    <p><strong>Title:</strong> <?php echo $news['title']; ?></p>
    <p><strong>Category:</strong> <?php echo $news['category_name']; ?></p>
    <p><strong>Details:</strong><br><?php echo nl2br($news['details']); ?></p>
    <p><strong>Image:</strong><br>
        <?php 
        if (!empty($news['image'])) {
            echo "<img src='uploads/" . $news['image'] . "' width='300'>";
        } else {
            echo "No image available";
        }
        ?>
    </p>
    <p><strong>User ID:</strong> <?php echo $news['user_id']; ?></p>

    <br>
    <a href="view_news.php">Back to News List</a>
</body>
</html>
