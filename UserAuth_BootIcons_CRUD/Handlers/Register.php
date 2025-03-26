<?php
session_start();
include(__DIR__ . '/../DatabaseConnection/Connection.php');

if (!isset($conn)) {
    die("Database connection failed! Check Connection.php");
}

// Debug connection
if (!$conn) {
    die("Database connection is missing in Register.php!");
} else {
    echo "Database connection is working in Register.php!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Getting the user input data from the form
    $firstName = trim($_POST['fName']);
    $lastName = trim($_POST['lName']);
    $dob = $_POST['dob'];
    $phoneNumber = trim($_POST['number']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    //Hashing the password for security purposes
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    //Checking if the username or email already exists in the database
    $checkUser = $conn->prepare("SELECT * FROM users_list WHERE Username = ? OR EmailAddress = ?");
    $checkUser->bind_param("ss", $username, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        die("Username or Email already exists!");
    } else {
        //Inserting the user data into the database and creating a new user
        $insertQuery = $conn->prepare("INSERT INTO users_list (FirstName, LastName, DateofBirth, PhoneNumber, Username, EmailAddress, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertQuery->bind_param("sssssss", $firstName, $lastName, $dob, $phoneNumber, $username, $email, $password);

        if ($insertQuery->execute()) {
            header("Location: ../Index.php"); //Redirecting the user to the login page after successful registration
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
