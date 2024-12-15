<?php
$servername = "localhost";
$username = "root";
$password = "Barambu@2024";
$dbname = "BogaDev";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the input data
    $regno = $conn->real_escape_string($_POST['regno']);
    $modifyName = isset($_POST['modifyName']) ? mysqli_real_escape_string($conn, $_POST['modifyName']) : '';
    $modifyEmail = isset($_POST['modifyEmail']) ? mysqli_real_escape_string($conn, $_POST['modifyEmail']) : '';
    
    // Construct the UPDATE query
    $sql = "UPDATE student SET studentname = '$modifyName', email = '$modifyEmail' WHERE registrationNo = '$regno'";


    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the Modify Student page
        header("Location: student_htm.php");
        exit;
        //echo "Seccessful";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the connection
$conn->close();


exit;

?>
