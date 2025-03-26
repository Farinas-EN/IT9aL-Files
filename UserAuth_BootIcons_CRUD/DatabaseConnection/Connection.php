<?php
$servername = "localhost";
$username = "root";
$password = ""; // Change this if you have a MySQL password
$dbname = "usermanagementdatabase"; // Ensure this matches EXACTLY in phpMyAdmin

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Attempt connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if connection was successful
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    } else {
        // echo "Database connected successfully!";
    }
} catch (mysqli_sql_exception $e) {
    die("ERROR: " . $e->getMessage());
}
?>
