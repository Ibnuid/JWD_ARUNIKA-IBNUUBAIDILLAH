<?php
require 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$package = $_POST['package'];
$date = $_POST['date'];

// Insert booking data into database
$sql = "INSERT INTO bookings (customer_name, email, phone, tour_package_id, booking_date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssis", $name, $email, $phone, $package, $date);

if ($stmt->execute()) {
    // Redirect to invoice page with booking ID
    $booking_id = $stmt->insert_id;
    header("Location: invoice.php?id=$booking_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
