<?php
session_start();
include './backend-logics/dbcon.php';

// Only authors
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'author') {
    die("Access denied");
}

if (isset($_POST['publish'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // Handle image upload
    $image_name = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = time() . "_" . basename($_FILES['image']['name']); // unique name
        $target = "uploads/" . $image_name;
        move_uploaded_file($image_tmp, $target);
    }

    $stmt = $Connection->prepare(
        "INSERT INTO posts (user_id, title, content, image) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("isss", $user_id, $title, $content, $image_name);
    $stmt->execute();

    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="./CSS/create-post.css">
</head>
<body>
<h2>Create New Post</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Post Title" required><br><br>
    <textarea name="content" placeholder="Write your post..." required></textarea><br><br>
    <input type="file" name="image" accept="image/*"><br><br>
    <button type="submit" name="publish">Publish</button>
</form>
</body>
</html>
