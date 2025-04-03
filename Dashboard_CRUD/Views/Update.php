<?php
include('../Database Connection/Connection.php');

if (!isset($_GET['id'])) {
    die("Recipe ID missing!");
}

$recipeID = $_GET['id'];

// Fetch existing recipe
$sql = "SELECT * FROM recipes WHERE RecipeID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipeID);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipeName = trim($_POST['recipeName']);
    $description = trim($_POST['description']);
    $createdBy = trim($_POST['createdBy']);

    // No image handling now
    $updateSQL = "UPDATE recipes SET RecipeName = ?, Description = ?, CreatedBy = ? WHERE RecipeID = ?";
    $stmt = $conn->prepare($updateSQL);
    $stmt->bind_param("sssi", $recipeName, $description, $createdBy, $recipeID);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="../Assets/style.css">
</head>
<body>
    <h2>Edit Recipe</h2>
    <form action="" method="POST">
        <input type="text" name="recipeName" value="<?php echo $recipe['RecipeName']; ?>" required>
        <textarea name="description"><?php echo $recipe['Description']; ?></textarea>
        <input type="text" name="createdBy" value="<?php echo $recipe['CreatedBy']; ?>" required>
        <button type="submit">Update Recipe</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
