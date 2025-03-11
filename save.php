<?php
// Database configuration
$servername = "sql200.infinityfree.com"; // Database server address
$username = "if0_37529146"; // Change to your database username
$password = "ERoXAjljN3x";   // Change to your database password
$dbname = "if0_37529146_441week41"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$data = file_get_contents('php://input');
$classes = json_decode($data, true);

if (!empty($classes)) {
    $stmt = $conn->prepare("INSERT INTO timetable (subject, day, time, teacher) VALUES (?, ?, ?, ?)"); 

    // Loop through each class in the $classes array
    foreach ($classes as $class) {
        $subject = $class['subject'];
        $day = $class['day'];
        $time = $class['time'];
        $teacher = $class['teacher']; 
         // Bind the parameters to the SQL statement with the corresponding variables
        $stmt->bind_param("ssss", $subject, $day, $time, $teacher); 

        // Execute the SQL statement
        if (!$stmt->execute()) {
            echo json_encode(['status' => 'error', 'message' => 'Error inserting data: ' . $stmt->error]);
            exit;
        }
    }

    $stmt->close();
    // Output a success message
    echo json_encode(['status' => 'success', 'message' => 'Data saved successfully!']);
} else {
    // If the $classes array is empty, output an error message
    echo json_encode(['status' => 'error', 'message' => 'No data received!']);
}

$conn->close();
?>