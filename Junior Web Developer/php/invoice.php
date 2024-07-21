<?php
require 'db.php';

$booking_id = $_GET['id'];

// Fetch booking details from the database
$sql = "SELECT b.id, b.customer_name, b.email, b.phone, b.booking_date, p.name as package_name, p.price
        FROM bookings b
        JOIN tour_packages p ON b.tour_package_id = p.id
        WHERE b.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Arunika Eatery Kuningan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Arunika Eatery Kuningan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.html">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="../booking.html">Pemesanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="../packages.html">Paket</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.html">Kontak</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container my-5">
        <section>
            <h1 class="mb-4">Invoice</h1>
            <p> Tolong di Screenshot dan catat no booking ID pembelian Anda, Terimakasih.</p>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking Details</h5>
                    <p class="card-text"><strong>Booking ID:</strong> <?php echo $booking['id']; ?></p>
                    <p class="card-text"><strong>Name:</strong> <?php echo $booking['customer_name']; ?></p>
                    <p class="card-text"><strong>Email:</strong> <?php echo $booking['email']; ?></p>
                    <p class="card-text"><strong>Phone:</strong> <?php echo $booking['phone']; ?></p>
                    <p class="card-text"><strong>Package:</strong> <?php echo $booking['package_name']; ?></p>
                    <p class="card-text"><strong>Price:</strong> <?php echo $booking['price']; ?></p>
                    <p class="card-text"><strong>Date:</strong> <?php echo $booking['booking_date']; ?></p>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Arunika Eatery Kuningan. Ibnu Ubaidillah.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
