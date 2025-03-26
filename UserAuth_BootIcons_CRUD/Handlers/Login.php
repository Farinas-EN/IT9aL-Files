<?php
session_start();
include(__DIR__ . '/../DatabaseConnection/Connection.php'); // Include the database connection file


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

//Query check if user data exists in the database
    $sql = "SELECT * FROM users_list WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

//Verifying the inputted password of the user
        if (password_verify($password, $user['Password'])) {
            $_SESSION['username'] = $username;
            header("Location: ../Dashboard.php");//Redirect to the dashboard page
            exit();
        } else {
            echo "Invalid username or password!"; //Invalid inputted username or password
        }
    } else {
        echo "Invalid username or password!"; //Invalid inputted username or password
    }
}
?>
