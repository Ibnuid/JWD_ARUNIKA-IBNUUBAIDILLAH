<?php
session_start();
require 'db.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $package = $_POST['tour_package_id'];
    $date = $_POST['booking_date'];

    $sql = "UPDATE bookings SET customer_name = ?, email = ?, phone = ?, tour_package_id = ?, booking_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi", $name, $email, $phone, $package, $date, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Edit Booking</title>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h1>Edit Booking</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="customer_name">Nama</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $booking['customer_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $booking['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $booking['phone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tour_package_id">Paket Wisata</label>
                <input type="text" class="form-control" id="tour_package_id" name="tour_package_id" value="<?php echo $booking['tour_package_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="booking_date">Tanggal Pemesanan</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date" value="<?php echo $booking['booking_date']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
