<?php
// db_connection.php - Database connection script
$servername = "localhost";
$username = "root";
$password = "Barambu@2024";
$dbname = "BogaDev";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
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
        <h1>Welcome, Student</h1>

        <!-- Student Search Form -->
        <div class="form-container">
            <h2>Enter Your Details</h2>
            <form action="student.php" method="POST">
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                <input type="text" id="regno" name="regno" placeholder="Enter your registration number" required>
                <button type="submit">View Details</button>
            </form>
        </div>

        <!-- Student Details Section -->
        <div class="student-details" id="studentDetails" style="display: none;">
            <h2>Your Details</h2>
            <p><strong>Name:</strong> <span id="studentName"></span></p>
            <p><strong>Email:</strong> <span id="studentEmail"></span></p>
            <p><strong>Registration Number:</strong> <span id="studentRegno"></span></p>
            <p><strong>Department:</strong> <span id="studentDepartment"></span></p>
            <p><strong>Course:</strong> <span id="studentCourse"></span></p>
            <button id="modifyButton">Modify Name & Email</button>
        </div>

        <!-- Modify Form -->
        <div class="modify-container" id="modifyContainer" style="display: none;">
            <h2>Modify Your Details</h2>
            <input type="text" id="modifyName" placeholder="Enter new name" required>
            <input type="email" id="modifyEmail" placeholder="Enter new email" required>
            <button id="saveChanges">Save Changes</button>
        </div>
    </div>

    <script>
        let currentStudent = null;

        // Handle form submission for login
        document.getElementById("studentForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const name = document.getElementById("name").value.trim();
            const regno = document.getElementById("regno").value.trim();

            // Send login request to PHP to check student details
            fetch('student.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'name': name,
                    'regno': regno
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentStudent = data.student;
                    document.getElementById("studentName").textContent = currentStudent.name;
                    document.getElementById("studentEmail").textContent = currentStudent.email;
                    document.getElementById("studentRegno").textContent = currentStudent.regno;
                    document.getElementById("studentDepartment").textContent = currentStudent.department;
                    document.getElementById("studentCourse").textContent = currentStudent.course;
                    document.getElementById("studentDetails").style.display = "block";
                    document.getElementById("modifyContainer").style.display = "none";
                } else {
                    alert("Student not found or invalid details.");
                }
            });
        });

        // Show Modify Form
        document.getElementById("modifyButton").addEventListener("click", function() {
            document.getElementById("modifyName").value = currentStudent.name;
            document.getElementById("modifyEmail").value = currentStudent.email;
            document.getElementById("modifyContainer").style.display = "block";
        });

        // Save Changes
        document.getElementById("saveChanges").addEventListener("click", function() {
            const newName = document.getElementById("modifyName").value.trim();
            const newEmail = document.getElementById("modifyEmail").value.trim();

            // Send updated details to PHP for database update
            fetch('studentupdate.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'regno': currentStudent.regno,
                    'newName': newName,
                    'newEmail': newEmail
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentStudent.name = newName;
                    currentStudent.email = newEmail;
                    document.getElementById("studentName").textContent = currentStudent.name;
                    document.getElementById("studentEmail").textContent = currentStudent.email;
                    alert("Details updated successfully!");
                } else {
                    alert("Error updating details.");
                }
            });
        });
    </script>
</body>
</html>
