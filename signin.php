<?php
session_start(); // Start a session to store user information

// Include your database connection file
include('dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    // Perform SQL injection prevention (you may want to improve this further)
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);


    // Query to check if the user exists
    $query = "SELECT * FROM user WHERE Username='$username' AND Password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User found, set session variables and redirect to a welcome page
        $row = $result->fetch_assoc();
        $_SESSION['UserID'] = $row['UserID']; // Store user ID in the session
        $_SESSION['Username'] = $row['Username']; // Store username in the session
        $_SESSION['image_name'] = $row['image_name'];
        $_SESSION['image_data'] = $row['image_data'];
        header("Location: index.php"); // Redirect to welcome page
    } else {
        $error = "Invalid username or password";
        header("Location: signin.html"); // Redirect to welcome page
    }
}
?>
