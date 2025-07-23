<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ingenzi_events_db";

// Initialize response array
$response = array(
    'success' => false,
    'message' => ''
);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $event_id = $_POST['event_id'] ?? '';
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($event_id)) {
        $response['message'] = 'All fields are required.';
        echo json_encode($response);
        exit();
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Please enter a valid email address.';
        echo json_encode($response);
        exit();
    }
    
    // Validate phone number (basic validation)
    if (!preg_match("/^[0-9+\-\s\(\)]{10,}$/", $phone)) {
        $response['message'] = 'Please enter a valid phone number.';
        echo json_encode($response);
        exit();
    }
    
    // Validate event_id is numeric
    if (!is_numeric($event_id)) {
        $response['message'] = 'Invalid event selected.';
        echo json_encode($response);
        exit();
    }
    
    try {
        // Create database connection
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Check if event exists
        $stmt = $pdo->prepare("SELECT id FROM events WHERE id = ?");
        $stmt->execute([$event_id]);
        if (!$stmt->fetch()) {
            $response['message'] = 'Event not found.';
            echo json_encode($response);
            exit();
        }
        
        // Check if user is already registered for this event
        $stmt = $pdo->prepare("SELECT id FROM registrations WHERE email = ? AND event_id = ?");
        $stmt->execute([$email, $event_id]);
        if ($stmt->fetch()) {
            $response['message'] = 'You are already registered for this event.';
            echo json_encode($response);
            exit();
        }
        
        // Insert registration using prepared statement
        $stmt = $pdo->prepare("INSERT INTO registrations (name, email, phone, event_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $event_id]);
        
        // Success
        $response['success'] = true;
        $response['message'] = 'Registration successful!';
        
        // Redirect to thank you page
        header("Location: thankyou.html");
        exit();
        
    } catch(PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
        echo json_encode($response);
        exit();
    }
    
} else {
    // If not POST request, redirect to home
    header("Location: index.php");
    exit();
}
?> 