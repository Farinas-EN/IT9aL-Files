<?php
session_start();
include(__DIR__ . '/../DatabaseConnection/Connection.php');

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../Index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $createdBy = $_SESSION['username'];

    $query = $conn->prepare("INSERT INTO recipes (Title, Description, CreatedBy) VALUES (?, ?, ?)");
    $query->bind_param("sss", $title, $description, $createdBy);

    if ($query->execute()) {
        header("Location: ../Dashboard.php");
        exit();
    } else {
        die("❌ ERROR: Could not save recipe - " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="../Assets/AddRecipe.css">
</head>
<body>
    <div class="container">
        <h2>Add a New Recipe</h2>
        <form method="POST">
            <label>Recipe Title:</label>
            <input type="text" name="title" required>

            <label>Description:</label>
            <textarea name="description" required></textarea>

            <button type="submit">Save Recipe</button>
        </form>
        <a href="../Dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
