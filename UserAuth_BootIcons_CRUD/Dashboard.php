<?php
session_start();
include(__DIR__ . '/DatabaseConnection/Connection.php'); // Include database connection

// Redirect users to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: Index.php");
    exit();
}

// Fetch all recipes from the database, ordered by newest first
$sql = "SELECT RecipeID, Title, Description, CreatedBy, CreatedAt FROM recipes ORDER BY CreatedAt DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Dashboard</title>

    <!-- 🔹 Link to your custom CSS file -->
    <link rel="stylesheet" href="Assets/styledashboard.css"> 

    <!-- 🔹 Include Bootstrap for additional styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Dashboard Container -->
    <div class="container">
        <h2 class="dashboard-title">Recipe Dashboard</h2> <!-- ✏️ Customize heading with CSS -->

        <!-- Add New Recipe Button (Use 'btn-add' class to style) -->
        <a href="Handlers/AddRecipe.php" class="btn btn-primary btn-add">+ Add New Recipe</a>

        <!-- Recipe List Table (Use 'recipe-table' class for styling) -->
        <table class="table recipe-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($recipe = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $recipe['RecipeID']; ?></td>

                    <!-- ✏️ Use 'recipe-title' class to customize how recipe names appear -->
                    <td class="recipe-title"><?php echo htmlspecialchars($recipe['Title']); ?></td>

                    <!-- ✏️ Limit the displayed description and apply 'recipe-desc' class for text styling -->
                    <td class="recipe-desc"><?php echo htmlspecialchars(substr($recipe['Description'], 0, 50)) . '...'; ?></td>

                    <td><?php echo htmlspecialchars($recipe['CreatedBy']); ?></td>

                    <td>
                        <!-- Edit & Delete Buttons (Use 'btn-edit' & 'btn-delete' classes for styling) -->
                        <a href="Handlers/EditRecipe.php?id=<?php echo $recipe['RecipeID']; ?>" class="btn btn-warning btn-edit">Edit</a>
                        <a href="Handlers/DeleteRecipe.php?id=<?php echo $recipe['RecipeID']; ?>" 
                             class="btn btn-danger btn-delete"
                        onclick="return confirm('Are you sure you want to delete this recipe?');">
   Delete
</a>

                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Logout Button (Use 'btn-logout' class to style it) -->
        <a href="Logout.php" class="btn btn-danger btn-logout">Log Out</a>
    </div>

</body>
</html>
<?php $conn->close(); ?>
