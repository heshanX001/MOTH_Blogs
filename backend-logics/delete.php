<?php
session_start();
include 'dbcon.php';

// Only logged-in users
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'author') {
    die("Access denied");
}

if (isset($_POST['delete'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    // Make sure the logged-in user owns this post
    $stmt = $Connection->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();

    header("Location: ../home.php");
    exit();
}
