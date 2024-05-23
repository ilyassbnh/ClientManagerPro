<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the sign-in page
    header("Location: ./sign/signin.php");
    exit();
}

// User is logged in, retrieve user information
$userid = $_SESSION['user_id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
?>
<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO Clients (full_name, email, phone_number , userid) VALUES (?, ?, ? ,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone , $userid);

    if ($stmt->execute()) {
        header("Location: ../acceuil.php?message=Client added successfully");
        exit();
    } else {
        header("Location: ../acceuil.php?error=" . urlencode("Error adding client: " . $stmt->error));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
