<?php
// Database connection
require 'db.php';

// Error handling
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tour packages from the database
$sql = "SELECT * FROM tour_packages";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error: " . $conn->error);
}

$packages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}

echo '<pre>';
print_r($packages);
echo '</pre>';

$conn->close();
?>
