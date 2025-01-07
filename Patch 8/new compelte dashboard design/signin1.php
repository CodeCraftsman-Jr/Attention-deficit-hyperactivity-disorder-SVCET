<?php
$servername = "sql210.infinityfree.com"; // Can change based on your hosting settings
$username = "if0_37517154"; // your database username
$password = "1slLMeZbqe7IyKy"; // your database password
$dbname = "if0_37517154_user_database"; // the database created above

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($pass, $user['password'])) {
            // Session: Store user_id and associated test_id
            $_SESSION['user_id'] = $user['id'];  // Store user ID for session
            $_SESSION['test_id'] = $user['test_id']; // Retrieve and store the existing test ID

            echo "Logged in successfully! Welcome.";
            // Redirect to user dashboard or homepage
            header('Location: index.html');
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "No user found with this email!";
    }
}

$conn->close();
?>
