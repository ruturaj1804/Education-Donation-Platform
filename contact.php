<?php
$servername = "localhost";
$username = "root"; // Change if using a different user
$password = ""; // Add password if set
$dbname = "db_donate";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    
    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
        exit;
    }
    
    // Insert data into database using a prepared statement
    $stmt = $conn->prepare("INSERT INTO contact_db (name, email, message) VALUES (?, ?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);
        
        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully.'); window.location.href='contact.html';</script>";
        } else {
            echo "<script>alert('Error saving message. Please try again later.'); window.history.back();</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('Database error. Please try again later.'); window.history.back();</script>";
    }
}

$conn->close();
?>