<?php
$connection = new mysqli("localhost", "root", "", "Assignment4");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$sql = "SELECT * FROM categories";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Categories</title>
</head>
<body>
    <h2>All Categories</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No categories found</td></tr>";
        }
        ?>
    </table>

    <br>
    <a href="dashboard.php">Back to Dashboard Page</a>
</body>
</html>
