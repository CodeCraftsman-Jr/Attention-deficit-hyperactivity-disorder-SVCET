<?php
$servername = "sql210.infinityfree.com"; // Can change based on your hosting settings
$username = "if0_37517154"; // your database username
$password = "1slLMeZbqe7IyKy"; // your database password
$dbname = "if0_37517154_user_database"; // the database created above

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

    // Insert user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
        // Redirect to the sign-in page or login page
        header('Location: index.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>