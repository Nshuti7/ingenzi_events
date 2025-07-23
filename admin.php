<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Ingenzi Events</title>
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="admin.php" class="active">Admin</a></li>
                    <li><a href="admin_logout.php" class="logout-link">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <section class="admin-section">
                <h2>Admin Dashboard</h2>
                <p>View all event registrations and contact messages</p>
                
                <!-- Navigation tabs -->
                <div class="admin-tabs">
                    <button class="tab-button active" onclick="showTab('registrations')">Event Registrations</button>
                    <button class="tab-button" onclick="showTab('messages')">Contact Messages</button>
                </div>

                <!-- Registrations Tab -->
                <div id="registrations-tab" class="tab-content active">
                    <?php
                    // Database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "ingenzi_events_db";

                    try {
                        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Fetch all registrations with event names
                        $stmt = $pdo->prepare("
                            SELECT r.*, e.event_name, e.event_date 
                            FROM registrations r 
                            JOIN events e ON r.event_id = e.id 
                            ORDER BY r.reg_date DESC
                        ");
                        $stmt->execute();
                        $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($registrations) > 0) {
                            echo '<div class="table-container">';
                            echo '<table class="admin-table">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Name</th>';
                            echo '<th>Email</th>';
                            echo '<th>Phone</th>';
                            echo '<th>Event</th>';
                            echo '<th>Event Date</th>';
                            echo '<th>Registration Date</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            
                            foreach ($registrations as $reg) {
                                echo '<tr>';
                                echo '<td>' . $reg['id'] . '</td>';
                                echo '<td>' . htmlspecialchars($reg['name']) . '</td>';
                                echo '<td>' . htmlspecialchars($reg['email']) . '</td>';
                                echo '<td>' . htmlspecialchars($reg['phone']) . '</td>';
                                echo '<td>' . htmlspecialchars($reg['event_name']) . '</td>';
                                echo '<td>' . date('M j, Y', strtotime($reg['event_date'])) . '</td>';
                                echo '<td>' . date('M j, Y g:i A', strtotime($reg['reg_date'])) . '</td>';
                                echo '</tr>';
                            }
                            
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                            
                            echo '<div class="stats">';
                            echo '<p><strong>Total Registrations:</strong> ' . count($registrations) . '</p>';
                            echo '</div>';
                            
                        } else {
                            echo '<div class="no-data">';
                            echo '<p>No registrations found.</p>';
                            echo '</div>';
                        }
                        
                    } catch(PDOException $e) {
                        echo '<div class="error-message">Error: ' . $e->getMessage() . '</div>';
                    }
                    ?>
                </div>

                <!-- Messages Tab -->
                <div id="messages-tab" class="tab-content">
                    <?php
                    try {
                        // Fetch all contact messages
                        $stmt = $pdo->prepare("
                            SELECT * FROM contact_messages 
                            ORDER BY created_at DESC
                        ");
                        $stmt->execute();
                        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($messages) > 0) {
                            echo '<div class="table-container">';
                            echo '<table class="admin-table">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Name</th>';
                            echo '<th>Email</th>';
                            echo '<th>Subject</th>';
                            echo '<th>Message</th>';
                            echo '<th>Date</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            
                            foreach ($messages as $msg) {
                                echo '<tr>';
                                echo '<td>' . $msg['id'] . '</td>';
                                echo '<td>' . htmlspecialchars($msg['name']) . '</td>';
                                echo '<td>' . htmlspecialchars($msg['email']) . '</td>';
                                echo '<td>' . htmlspecialchars($msg['subject']) . '</td>';
                                echo '<td>' . htmlspecialchars(substr($msg['message'], 0, 50)) . (strlen($msg['message']) > 50 ? '...' : '') . '</td>';
                                echo '<td>' . date('M j, Y g:i A', strtotime($msg['created_at'])) . '</td>';
                                echo '</tr>';
                            }
                            
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                            
                            echo '<div class="stats">';
                            echo '<p><strong>Total Messages:</strong> ' . count($messages) . '</p>';
                            echo '</div>';
                            
                        } else {
                            echo '<div class="no-data">';
                            echo '<p>No contact messages found.</p>';
                            echo '</div>';
                        }
                        
                    } catch(PDOException $e) {
                        echo '<div class="error-message">Error: ' . $e->getMessage() . '</div>';
                    }
                    ?>
                </div>

                <div class="admin-actions">
                    <a href="index.php" class="btn-back">← Back to Home</a>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 INGENZI EVENTS. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all buttons
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.add('active');
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }
    </script>
</body>
</html> 