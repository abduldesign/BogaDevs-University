<?php
// Database connection
$conn = new mysqli("localhost", "root", "Barambu@2024", "BogaDev");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch updated data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$regno = $_POST['regno'];
$department = $_POST['department'];
$course = $_POST['course'];
$original_email = $_POST['original_email'];

// Update query
$sql = "UPDATE student 
        SET studentname = '$name', email = '$email', registrationNo = '$regno', department = '$department', course = '$course' 
        WHERE email = '$original_email'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully!";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

// Redirect back to the Modify Student page
header("Location: modify_student.php");
exit;
?>
