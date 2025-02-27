<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Now</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header class="flex_space">
        <h2>Booking Now</h2>
        <nav>
            <ul class="navlinks">
                <li><a href="index.html">Home</a></li>
                <li><a href="rooms.html">Rooms</a></li>
                <li><a href="booking.html" class="active">Booking</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="book">
        <div class="container text-center">
            <h1>Book Your <span>Stay</span></h1>
            <form action="submit_booking.php" method="POST" class="grid">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="date" name="checkin" required>
                <input type="date" name="checkout" required>
                <input type="number" name="guests" placeholder="Number of Guests" required>
                <input type="submit" value="Book Now" class="primary-btn">
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
