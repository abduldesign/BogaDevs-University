<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <style>
        body {
            background-image: url('background\ login\ 2.jpg');
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
        }
        .container h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
            vertical-align: middle;
        }
        table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        table td input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            box-sizing: border-box;
        }
        .btn-delete {
            background: red;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Student Records</h2>
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Registration Number</th>
                    <th>Department</th>
                    <th>Course</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli("localhost", "root", "Barambu@2024", "BogaDev");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the database
                $sql = "SELECT * FROM student";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <form action='delete_student4rmdb.php' method='POST'>
                                    <td><input type='text' name='name' value='{$row["studentname"]}'></td>
                                    <td><input type='email' name='email' value='{$row["email"]}'></td>
                                    <td><input type='text' name='regno' value='{$row["registrationNo"]}'></td>
                                    <td><input type='text' name='department' value='{$row["department"]}'></td>
                                    <td><input type='text' name='course' value='{$row["course"]}'></td>
                                    <td>
                                        <input type='hidden' name='original_email' value='{$row["email"]}'>
                                        <button type='submit' class='btn-delete'>Delete</button>
                                    </td>
                                </form>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
