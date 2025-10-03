<?php
$connection= new mysqli("localhost","root","","Assignment4");
if($connection->error == true){
    echo "Connection fail";
}else{
    echo "Connected";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<h2>القائمة الرئيسية</h2>
    <ul>
        <li><a href="add_category.php">Add Category</a></li>
        <li><a href="view_categories.php">View Categories</a></li>
        <li><a href="add_news.php">Add News</a></li>
        <li><a href="view_news.php">View News</a></li>
        <li><a href="deleted_news.php">Deleted News</a></li>
    </ul>
</body>
</html>
