<?php
include 'dbcon.php';

if(isset($_POST['signup'])){

    // Get form data :)
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];
    $role = $_POST['role'];

    if($password !== $confirmPassword){
        die("Passwords do not match.");
    }

    // checking username
    $stmt = $Connection->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        die("Username already taken. Choose another.");
    }
    $stmt->close();

    // Hashing the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user into database
    $stmt = $Connection->prepare("INSERT INTO users (fname, lname, username, password, role,email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $username, $hashedPassword, $role, $email);

    if($stmt->execute()){
        header("Location: ../login.php");
        exit();
    } else {
        echo "Error: " . $Connection->error;
    }

    $stmt->close();
    $Connection->close();
}
?>
