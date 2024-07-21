<?php
// Database connection
require 'db.php';

// Fetch tour packages from the database
$sql = "SELECT * FROM tour_packages";
$result = $conn->query($sql);

$packages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($packages);

$conn->close();
?>
