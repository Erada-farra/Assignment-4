<?php
$connection = new mysqli("localhost", "root", "", "Assignment4");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET['restore_id'])) {
    $restore_id = intval($_GET['restore_id']);
    $connection->query("UPDATE news SET deleted=0 WHERE id=$restore_id");
}

$sql = "SELECT news.*, categories.name AS category_name 
        FROM news 
        LEFT JOIN categories ON news.category_id = categories.id 
        WHERE news.deleted=1";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleted News</title>
</head>
<body>
    <h2>Deleted News</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Details</th>
            <th>Image</th>
            <th>User ID</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['category_name'] . "</td>";
                echo "<td>" . $row['details'] . "</td>";
                echo "<td>";
                if (!empty($row['image'])) {
                    echo "<img src='uploads/" . $row['image'] . "' width='100'>";
                }
                echo "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>
                        <a href='deleted_news.php?restore_id=" . $row['id'] . "' onclick=\"return confirm('Restore this news?')\">Restore</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No deleted news found</td></tr>";
        }
        ?>
    </table>

    <br>
    <a href="dashboard.php">Back to Dashboard Page</a>
</body>
</html>
