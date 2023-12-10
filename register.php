<?php
// Include your database connection file (dbconn.php)
include('dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the registration form
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];

    // Insert user data into the database
    $query = "INSERT INTO user (Username, Password, Email) VALUES ('$username', '$password', '$email')";
    
    if ($conn->query($query) === TRUE) {
        // Registration successful
        echo "Registration successful. You can now <a href='signin.html'>log in</a>.";
    } else {
        // Registration failed
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
