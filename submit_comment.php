<?php
// submit_comment.php

// Start or resume the session
session_start();
include('dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize input data
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '';
    
    // Perform additional validation if needed

    // Process the comment (e.g., save it to a database)
    // Replace the following code with your actual database logic
    $userID = $_SESSION['UserID'];
    $imageData = $_SESSION['image_data'];
    $imageName = $_SESSION['image_name'];

    // Your database connection logic here

    // Insert the comment into the database
    // Replace the following code with your actual SQL query
    $sql = "INSERT INTO review (UserID, Rating, Comment, Review_Date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userID, $rating, $comment]);

    // Close the database connection if needed

    // Redirect to a success page or the original page
    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: $previousPage");
    exit();
}
?>
