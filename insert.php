<?php
// Connect to MySQL
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "teamo roofing"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input to prevent XSS (Cross-Site Scripting)
$full_name = htmlspecialchars($_POST['full_name']);
$phone_number = htmlspecialchars($_POST['phone_number']);
$email = htmlspecialchars($_POST['email']);
$cart_summary = htmlspecialchars($_POST['cart_summary']);
$your_message_on_further_instructions = htmlspecialchars($_POST['your_message_on_futher_instructions']); // Typo in variable name?

// Prepared Statement to prevent SQL Injection
$stmt = $conn->prepare("INSERT INTO orders (full_name, phone_number, email, cart_summary, your_message_on_further_instructions) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $full_name, $phone_number, $email, $cart_summary, $your_message_on_further_instructions);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
