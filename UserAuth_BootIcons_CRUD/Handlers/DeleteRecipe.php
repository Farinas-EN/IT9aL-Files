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
$query = $conn->prepare("DELETE FROM recipes WHERE RecipeID = ?");
$query->bind_param("i", $recipeID);

if ($query->execute()) {
    header("Location: ../Dashboard.php");
    exit();
} else {
    die("❌ ERROR: Failed to delete recipe - " . $conn->error);
}
?>
