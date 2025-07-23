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
    $name = trim($_POST['contactName'] ?? '');
    $email = trim($_POST['contactEmail'] ?? '');
    $subject = trim($_POST['contactSubject'] ?? '');
    $message = trim($_POST['contactMessage'] ?? '');
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
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
    
    // Validate name length
    if (strlen($name) < 2) {
        $response['message'] = 'Name must be at least 2 characters long.';
        echo json_encode($response);
        exit();
    }
    
    // Validate subject length
    if (strlen($subject) < 5) {
        $response['message'] = 'Subject must be at least 5 characters long.';
        echo json_encode($response);
        exit();
    }
    
    // Validate message length
    if (strlen($message) < 10) {
        $response['message'] = 'Message must be at least 10 characters long.';
        echo json_encode($response);
        exit();
    }
    
    try {
        // Create database connection
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Insert message using prepared statement
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);
        
        // Success
        $response['success'] = true;
        $response['message'] = 'Message sent successfully! We will get back to you soon.';
        
        // Redirect to thank you page
        header("Location: thankyou.html");
        exit();
        
    } catch(PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
    
} else {
    // If not POST request, redirect to contact page
    header("Location: contact.html");
    exit();
}

// Return JSON response (only if there was an error)
header('Content-Type: application/json');
echo json_encode($response);
?> 