<?php
// Database connection
$servername = "localhost";
$username = "root";  // Your database username
$password = "Barambu@2024";      // Your database password
$dbname = "BogaDev"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize current student variable
$currentStudent = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch student details based on name and regno
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);

    $sql = "SELECT * FROM student WHERE studentname = '$name' AND registrationNo = '$regno'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $currentStudent = $result->fetch_assoc(); // Fetch the student data
    } else {
        $errorMessage = "Student not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Style the page similar to form-container */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .page-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h1 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-container {
            margin-bottom: 30px;
        }

        .form-container h2 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #555;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-container button {
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #0056b3;
        }

        .student-details {
            display: none;
            text-align: left;
        }

        .student-details h2 {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }

        .student-details p {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .modify-container {
            display: none;
            margin-top: 20px;
        }

        .modify-container input {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modify-container button {
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .modify-container button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Student Search Form -->
        <div class="form-container">
            <h2>Welcome</h2>
        </div>

        <!-- Student Details Section -->
        <?php if ($currentStudent): ?>
            <div class="student-details" id="studentDetails" style="display:block;">
                <h2>Your Details</h2>
                <p><strong>Name:</strong> <span id="studentName"><?= $currentStudent['studentname']; ?></span></p>
                <p><strong>Email:</strong> <span id="studentEmail"><?= $currentStudent['email']; ?></span></p>
                <p><strong>Registration Number:</strong> <span id="studentRegno"><?= $currentStudent['registrationNo']; ?></span></p>
                <p><strong>Department:</strong> <span id="studentDepartment"><?= $currentStudent['department']; ?></span></p>
                <p><strong>Course:</strong> <span id="studentCourse"><?= $currentStudent['course']; ?></span></p>
            </div>

            <!-- Modify Form -->
            <div class="modify-container" id="modifyContainer" style="display:block;">
                <h2>Modify Your Details</h2>
                <form method="POST" action="studentupdate.php">
                    <input type="hidden" name="regno" value="<?= $currentStudent['registrationNo']; ?>"> <!-- hidden field for regno -->
                    <input type="text" name="modifyName" placeholder="Enter new name" value="<?= $currentStudent['studentname']; ?>" required>
                    <input type="email" name="modifyEmail" placeholder="Enter new email" value="<?= $currentStudent['email']; ?>" required>
                    <button type="submit">Save Changes</button>
                </form>

                                </div>
        <?php elseif(isset($errorMessage)): ?>
            <p style="color: red;"><?= $errorMessage; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
