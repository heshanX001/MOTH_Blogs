<?php
session_start();
include './backend-logics/dbcon.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all posts
$result = $Connection->query(
    "SELECT posts.*, users.fname, users.lname
     FROM posts
     JOIN users ON posts.user_id = users.id
     ORDER BY posts.created_at DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - IT_Bloggers</title>
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>

<header>
    <div><img src="./img/logo.png" alt="logo" class="logo"></div>
    <div class="logout-btn"><a href="./backend-logics/logout.php">Logout</a></div>
</header>

<div class="container">
    <div class="welcome">
        <h2>Welcome, 
            <?php 
                echo $_SESSION['fname']; 
            ?> !</h2>
        <p>You are logged in as 
            <?php 
            echo $_SESSION['role']; 
            ?>
        </p>
    </div>

    <?php 
        if ($_SESSION['role'] === 'author'){
        echo '<div class="create-post">
            <a href="./create-post.php">Create New Post</a>
            </div>';
        }
    ?>

    <h3>All Posts</h3>
    <div class="posts-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="post-card">
                    <?php if (!empty($row['image'])): ?>
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Post Image">
                    <?php endif; ?>
                    <h4><?php echo $row['title']; ?></h4>
                    <p><?php echo nl2br($row['content']); ?></p>
                    <small>By <?php echo $row['fname'] . ' ' . $row['lname']; ?> | <?php echo $row['created_at']; ?></small>

                    <?php if ($_SESSION['role'] === 'author' && $_SESSION['user_id'] == $row['user_id']): ?>
                        <form method="POST" action="./backend-logics/delete.php">
                            <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No posts available yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
