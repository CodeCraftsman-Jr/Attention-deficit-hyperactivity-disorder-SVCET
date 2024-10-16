<?php
// Database connection
include("connection.php");

if (isset($_POST['register'])) {
    // Collect and sanitize user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match. Please try again.";
        exit;
    }

    // Check if the username already exists in the login table
    $check_username = "SELECT * FROM login WHERE username='$username' LIMIT 1";
    $result = $conn->query($check_username);

    if ($result->num_rows > 0) {
        echo "This username is already taken. Please choose a different one.";
        exit;
    }

    // Insert the user into the login table with plain text password
    $sql = "INSERT INTO login (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location:home.html"); // Redirect to home page after successful registration
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
