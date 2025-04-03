<?php
// Include database connection
include(__DIR__ . '/../Database Connection/Connection.php'); 

// Fetch all recipes from the database
$sql = "SELECT RecipeID, RecipeName, Description, CreatedBy FROM recipes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Dashboard</title>
    
    <!-- Link to External CSS (Modify in Assets Folder) -->
    <link rel="stylesheet" href="../Assets/Dashboard.css">
</head>
<body>

    <div class="container">
        <h1>Recipe Dashboard</h1>

        <!-- Button to Add a New Recipe -->
        <a href="../Views/Create.php" class="btn">Add New Recipe</a>

        <!-- Display Recipes -->
        <div class="recipe-grid">
            <?php while ($recipe = $result->fetch_assoc()) { ?>
                <div class="recipe-card">

                    <!-- Recipe Details -->
                    <h3><?php echo $recipe['RecipeName']; ?></h3>
                    <p><?php echo $recipe['Description']; ?></p>
                    <p><strong>Created By:</strong> <?php echo $recipe['CreatedBy']; ?></p>

                    <!-- Edit & Delete Actions -->
                    <div class="actions">
                        <a href="../Views/Update.php?id=<?php echo $recipe['RecipeID']; ?>" class="edit-btn">Edit</a>
                        <a href="../Handlers/Delete.php?id=<?php echo $recipe['RecipeID']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php 
    // Close the database connection
    $conn->close(); 
    ?>

</body>
</html>
