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
function generateUniqueTestID($conn) {
    $isUnique = false;
    $uniqueID = '';

    while (!$isUnique) {
        $uniqueID = mt_rand(100000, 999999); // Generate 6-digit unique ID
        $query = "SELECT test_id FROM test_results WHERE test_id = '$uniqueID'";
        $result = $conn->query($query);

        if ($result->num_rows == 0) {
            $isUnique = true; // ID is unique, we can proceed
        }
    }

    return $uniqueID;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    
    // Generate the unique test ID for the new user
    $testID = generateUniqueTestID($conn);
    
    // Insert user and test ID into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, test_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user, $email, $pass, $testID);

    if ($stmt->execute()) {
        // Store test ID in session
        $_SESSION['user_id'] = $conn->insert_id; // store the user ID to manage session
        $_SESSION['test_id'] = $testID;  // Store test ID for later usage

        echo "New user created successfully!";
        header('Location: signin.php');  // Redirect to sign-in page
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
