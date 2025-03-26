<?php
session_start();
include(__DIR__ . '/../DatabaseConnection/Connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../Index.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("❌ ERROR: Recipe ID missing.");
}

$recipeID = $_GET['id'];
$query = $conn->prepare("SELECT Title, Description FROM recipes WHERE RecipeID = ?");
$query->bind_param("i", $recipeID);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    die("❌ ERROR: Recipe not found.");
}

$recipe = $result->fetch_assoc();

// Handle Update Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $updateQuery = $conn->prepare("UPDATE recipes SET Title=?, Description=? WHERE RecipeID=?");
    $updateQuery->bind_param("ssi", $title, $description, $recipeID);

    if ($updateQuery->execute()) {
        header("Location: ../Dashboard.php");
        exit();
    } else {
        die("❌ ERROR: Failed to update recipe - " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="../Assets/EditRecipe.css">
</head>
<body>
    <div class="container">
        <h2>Edit Recipe</h2>
        <form method="POST">
            <label>Recipe Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($recipe['Title']); ?>" required>

            <label>Description:</label>
            <textarea name="description" required><?php echo htmlspecialchars($recipe['Description']); ?></textarea>

            <button type="submit">Update Recipe</button>
        </form>
        <a href="../Dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
