<?php
$connection = new mysqli("localhost", "root", "", "Assignment4");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$categories_result = $connection->query("SELECT * FROM categories");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $details = $_POST['details'];
    $user_id = $_POST['user_id'];

    $image_name = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image_name);
    }

    $sql = "INSERT INTO news (title, category_id, details, image, user_id) 
            VALUES ('$title', $category_id, '$details', '$image_name', $user_id)";
    if ($connection->query($sql) === TRUE) {
        echo "News added successfully!";
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add News</title>
</head>
<body>
    <h2>Add New News</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Category:</label><br>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php
            if ($categories_result->num_rows > 0) {
                while ($row = $categories_result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <label>Details:</label><br>
        <textarea name="details" rows="5" cols="40" required></textarea><br><br>

        <label>Image:</label><br>
        <input type="file" name="image"><br><br>

        <label>User ID:</label><br>
        <input type="number" name="user_id" required><br><br>

        <button type="submit">Add News</button>
    </form>

    <br>
    <a href="dashboard.php">Back to Dashboard Page</a>
</body>
</html>
