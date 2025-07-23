<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration - Ingenzi Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav-container">
                <h1 class="logo">Ingenzi Events</h1>
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="admin_login.php">Admin</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ingenzi_events_db";

            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                echo '<div class="error-message">Invalid event ID</div>';
                echo '<a href="index.php" class="btn-back">Back to Home</a>';
                exit();
            }

            $event_id = $_GET['id'];

            try {
                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Fetch event details
                $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
                $stmt->execute([$event_id]);
                $event = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$event) {
                    echo '<div class="error-message">Event not found</div>';
                    echo '<a href="index.php" class="btn-back">Back to Home</a>';
                    exit();
                }
            } catch(PDOException $e) {
                echo '<div class="error-message">Error: ' . $e->getMessage() . '</div>';
                exit();
            }
            ?>

            <section class="event-details">
                <h2><?php echo htmlspecialchars($event['event_name']); ?></h2>
                <div class="event-info">
                    <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event['event_date'])); ?></p>
                    <p><strong>Description:</strong></p>
                    <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                </div>
            </section>

            <section class="registration-form">
                <h3>Register for this Event</h3>
                <form id="registrationForm" action="submit.php" method="POST">
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                    
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required>
                        <span class="error" id="nameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                        <span class="error" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required>
                        <span class="error" id="phoneError"></span>
                    </div>

                    <button type="submit" class="btn-submit">Register for Event</button>
                </form>
            </section>

            <div class="back-link">
                <a href="index.php" class="btn-back">← Back to Events</a>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 INGENZI EVENTS. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html> 