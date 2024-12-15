<?php
// Database connection credentials
$host = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Replace with your database username
$password = "Barambu@2024"; // Replace with your database password
$database = "BogaDev"; // Database name

// Establish a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $regno = $conn->real_escape_string($_POST["regno"]);
    $department = $conn->real_escape_string($_POST["department"]);
    $course = $conn->real_escape_string($_POST["course"]);

    // Insert the data into the database
    $sql = "INSERT INTO student (studentname, email, registrationNo, department, course) 
            VALUES ('$name', '$email', '$regno', '$department', '$course')";

    if ($conn->query($sql) === TRUE) {
        echo "Student added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
