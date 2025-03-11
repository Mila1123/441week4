<?php
$servername = "sql200.infinityfree.com"; // Database server address
$username = "if0_37529146"; // Change to your database username
$password = "ERoXAjljN3x";   // Change to your database password
$dbname = "if0_37529146_441week41";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, subject, day, time, teacher FROM timetable"; 
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Timetable Data</h1>
    <?php
    // Check if the query result has any data
    if ($result->num_rows > 0) {
        echo "<table>";
        // Output the table headers
        echo "<tr><th>ID</th><th>Subject</th><th>Day</th><th>Time</th><th>Teacher</th></tr>";
        // Loop through each row in the query result set
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            // Output the data for each column
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["subject"] . "</td>";
            echo "<td>" . $row["day"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";
            echo "<td>" . $row["teacher"] . "</td>"; 
            echo "</tr>";
        }
        // End the table
        echo "</table>";
    } else {
        // If there are no data, output a message
        echo "No records found in the timetable table.";
    }
    $conn->close();
    ?>
</body>
</html>