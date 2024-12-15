<?php
// Database connection
$conn = new mysqli("localhost", "root", "Barambu@2024", "BogaDev");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'original_email' is set and not empty
if (isset($_POST['original_email']) && !empty($_POST['original_email'])) {
    $email = $_POST['original_email'];

    // Prepare and bind the delete query to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM student WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the delete query
    if ($stmt->execute()) {
        // Redirect back to the delete page with a success message
        echo "<script>alert('Student deleted successfully!'); window.location.href='delete_student.php';</script>";
    } else {
        echo "<script>alert('Error deleting student. Please try again.'); window.location.href='delete_student.php';</script>";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "<script>alert('No student email provided.'); window.location.href='delete_student.php';</script>";
}

// Close the connection
$conn->close();
?>
