<?php
$connection = new mysqli("localhost", "root", "", "Assignment4");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO categories (name) VALUES ('$category_name')";
    if ($connection->query($sql) === TRUE) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
</head>
<body>
    <h2>Add New Category</h2>
    <form method="POST" action="">
        <label>Category Name:</label>
        <input type="text" name="category_name" required>
        <button type="submit">Save</button>
    </form>

    <br>
    <a href="dashboard.php">Back to Dashboard Page</a>
</body>
</html>
