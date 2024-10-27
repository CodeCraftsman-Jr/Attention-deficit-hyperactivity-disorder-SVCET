<?php
// Connect to the database
$servername = "sql210.infinityfree.com"; 
$username = "if0_37517154"; 
$password = "1slLMeZbqe7IyKy"; 
$dbname = "if0_37517154_useriddb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if test ID is provided in the request
if (isset($_POST['test_id'])) {
    $test_id = $_POST['test_id'];
    echo json_encode(['test_id' => $test_id]); // Return the existing test ID
    exit;
}

// Function to generate a 6-digit unique ID
function generateUniqueTestID($conn) {
    $isUnique = false;
    $uniqueID = '';

    while (!$isUnique) {
        $uniqueID = mt_rand(100000, 999999);
        $query = "SELECT test_id FROM test_results WHERE test_id = '$uniqueID'";
        $result = $conn->query($query);

        if ($result->num_rows == 0) {
            $isUnique = true;
        }
    }

    return $uniqueID;
}

// Generate the unique test ID
$uniqueTestID = generateUniqueTestID($conn);

// Store the test ID in the database
$stmt = $conn->prepare("INSERT INTO test_results (test_id) VALUES (?)");
$stmt->bind_param("s", $uniqueTestID);

if ($stmt->execute()) {
    echo json_encode(['test_id' => $uniqueTestID]);
} else {
    echo json_encode(['error' => 'Error storing test ID: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
