<?php
// Include database connection
include('../Database Connection/Connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipeName = trim($_POST['recipeName']);
    $description = trim($_POST['description']);
    $createdBy = trim($_POST['createdBy']);

    // Insert into database (No ImagePath)
    $sql = "INSERT INTO recipes (RecipeName, Description, CreatedBy) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $recipeName, $description, $createdBy);

    if ($stmt->execute()) {
        // Redirect back to dashboard after successful addition
        header("Location: ../Views/dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Recipe</title>
    <link rel="stylesheet" href="../Assets/Dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Add New Recipe</h1>

        <!-- Form to Add New Recipe -->
        <form action="" method="POST">
            <!-- Recipe Name Group -->
            <div class="input-group">
                <input type="text" name="recipeName" placeholder="Recipe Name" required>
                <label></label>
            </div>

            <!-- Recipe Description Group -->
            <div class="input-group">
                <textarea name="description" placeholder="Recipe Description" required></textarea>
                <label></label>
            </div>

            <!-- Your Name Group -->
            <div class="input-group">
                <input type="text" name="createdBy" placeholder="Your Name" required>
                <label></label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">Add Recipe</button>
        </form>

        <!-- Back to Dashboard Link -->
        <a href="dashboard.php" class="btn" style="background: #07001f; text-decoration: none;">Back to Dashboard</a>
    </div>
</body>
</html>
