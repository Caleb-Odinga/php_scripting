<?php
// Capture the form data using the $_POST array
$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];
$rating = $_POST['rating'];

// Establish a connection to the campaign_feedback database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campaign_feedback";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}
// Escape user input to prevent SQL injection
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$feedback = mysqli_real_escape_string($conn, $feedback);

// Insert the captured data into the feedback table
$sql = "INSERT INTO feedback (name, email, feedback, rating) VALUES ('$name', '$email', '$feedback', '$rating')";

if ($conn->query($sql) === TRUE) {
    // Provide a confirmation message to the user upon successful submission
    echo json_encode(["status" => "success", "message" => "Thank you for your feedback!"]);
} else {
    // Implement error handling to manage data insertion failures
    echo json_encode(["status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error]);
}

// Close connection
$conn->close();
?>
