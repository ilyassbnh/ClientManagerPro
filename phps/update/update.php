<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE Clients SET full_name=?, email=?, phone_number=? WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $id);

    if ($stmt->execute()) {
        header("Location: ../acceuil.php?message=Client updated successfully");
        exit();
    } else {
        header("Location: ../acceuil.php?error=" . urlencode("Error updating client: " . $stmt->error));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
