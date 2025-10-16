<?php
$connection = new mysqli("localhost", "root", "", "Assignment4");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
    if ($connection->query($sql) === TRUE) {
        echo "Account created successfully! <a href='login.php'>Go to Login</a>";
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Create New Account</h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>

    <br>
    <a href="login.php">Already have an account? Login</a>
</body>
</html>
