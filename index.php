<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingenzi Events - Event Registration Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav-container">
                <h1 class="logo">Ingenzi Events</h1>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="nav-menu">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="admin_login.php">Admin</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-slider">
                    <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
                        <div class="slide-content">
                            <h2>Welcome to Ingenzi Events</h2>
                            <p>Your premier platform for discovering and registering for exciting community events</p>
                        </div>
                    </div>
                    <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
                        <div class="slide-content">
                            <h2>Join Our Community</h2>
                            <p>Connect with like-minded people and create unforgettable memories</p>
                        </div>
                    </div>
                    <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
                        <div class="slide-content">
                            <h2>Easy Registration</h2>
                            <p>Simple and secure registration process for all your favorite events</p>
                        </div>
                    </div>
                    <div class="slider-dots">
                        <div class="slider-dot active"></div>
                        <div class="slider-dot"></div>
                        <div class="slider-dot"></div>
                    </div>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">5</span>
                        <span class="stat-label">Upcoming Events</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100+</span>
                        <span class="stat-label">Happy Participants</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Online Registration</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="features-section">
            <div class="container">
                <h3>Why Choose Ingenzi Events?</h3>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">📅</div>
                        <h4>Easy Registration</h4>
                        <p>Simple and quick registration process for all events</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <h4>Secure Platform</h4>
                        <p>Your information is safe with our secure database</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📱</div>
                        <h4>Mobile Friendly</h4>
                        <p>Register for events from any device, anywhere</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="events-section" id="events">
            <div class="container">
                <div class="section-header">
                    <h3>Upcoming Events</h3>
                    <p>Join our community events and connect with others</p>
                </div>
                <div class="events-grid">
                    <?php
                    // Database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "ingenzi_events_db";

                    try {
                        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Fetch upcoming events
                        $stmt = $pdo->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
                        $stmt->execute();
                        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($events) > 0) {
                            foreach ($events as $event) {
                                echo '<div class="event-card">';
                                echo '<h4>' . htmlspecialchars($event['event_name']) . '</h4>';
                                echo '<p class="event-date">' . date('F j, Y', strtotime($event['event_date'])) . '</p>';
                                echo '<p class="event-description">' . htmlspecialchars($event['description']) . '</p>';
                                echo '<a href="event.php?id=' . $event['id'] . '" class="btn-register">Register Now</a>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p class="no-events">No upcoming events at the moment. Check back soon!</p>';
                        }
                    } catch(PDOException $e) {
                        echo '<p class="error">Error: ' . $e->getMessage() . '</p>';
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <h3>Ready to Join Our Community?</h3>
                    <p>Browse our events and start your journey with us today</p>
                    <a href="#events" class="btn-primary">View All Events</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Ingenzi Events. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="script.js"></script>
</body>
</html> 