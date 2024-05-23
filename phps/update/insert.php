<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO Clients (full_name, email, phone_number) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $phone);

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
