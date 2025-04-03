<?php
include('../Database Connection/Connection.php');

if (isset($_GET['id'])) {
    $recipeID = $_GET['id'];

    $sql = "DELETE FROM recipes WHERE RecipeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeID);

    if ($stmt->execute()) {
        header("Location: ../Views/dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
