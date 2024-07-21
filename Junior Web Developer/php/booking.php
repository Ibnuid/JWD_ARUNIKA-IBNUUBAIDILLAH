<?php
// Database connection
require 'db.php';

// Get POST data
$customer_name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$tour_package_id = $_POST['package'];
$booking_date = $_POST['date'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (customer_name, email, phone, tour_package_id, booking_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $customer_name, $email, $phone, $tour_package_id, $booking_date);

// Execute and check
if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
