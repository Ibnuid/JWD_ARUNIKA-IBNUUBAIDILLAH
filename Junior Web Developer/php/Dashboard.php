<?php
session_start();
require 'db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Fetch booking data
$sql = "SELECT b.id, b.customer_name, b.email, b.phone, b.booking_date, p.name AS package_name
        FROM bookings b
        JOIN tour_packages p ON b.tour_package_id = p.id";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Arunika Eatery Kuningan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container my-5">
        <h2>Bookings</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Package</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['id']; ?></td>
                    <td><?php echo $booking['customer_name']; ?></td>
                    <td><?php echo $booking['email']; ?></td>
                    <td><?php echo $booking['phone']; ?></td>
                    <td><?php echo $booking['package_name']; ?></td>
                    <td><?php echo $booking['booking_date']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
