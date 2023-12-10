<?php
session_start(); // Start the session
if (!isset($_SESSION['UserID'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}
?>

<!-- Your welcome page content goes here -->
<h1>Welcome, <?php echo $_SESSION['Username']; ?>!</h1>
<a href="logout.php">Logout</a> <!-- Create a logout.php file to destroy the session -->
