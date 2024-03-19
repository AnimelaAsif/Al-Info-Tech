<?php
session_start();

// Check if username and password are set and valid
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate username and password (you should replace this with your own validation logic)
    if ($username === "asif" && $password === "asif") {
        // Authentication successful
        $_SESSION["loggedin"] = true;
        header("Location: upload.php");
        exit;
    } else {
        // Authentication failed
        echo "Invalid username or password.";
    }
}
?>
