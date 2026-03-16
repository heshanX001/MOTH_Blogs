<?php
session_start();
include 'dbcon.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id, fname, lname, password, role 
                FROM users WHERE username = ?";
    $stmt = $Connection->prepare($query);

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../home.php");
            exit();

        } else {
            die("Invalid password");
        }

    } else {
        die("User not found");
    }
}
?>
