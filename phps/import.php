<?php
include 'config.php';

if (isset($_FILES['csvfile']) && $_FILES['csvfile']['error'] == 0) {
    $filename = $_FILES['csvfile']['tmp_name'];
    $handle = fopen($filename, "r");

    if ($handle) {
        // Skip the first line (column headers)
        fgetcsv($handle);

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $id = $data[0];
            $full_name = $data[1];
            $email = $data[2];
            $phone_number = $data[3];

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO Clients (id, full_name, email, phone_number) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE full_name=VALUES(full_name), email=VALUES(email), phone_number=VALUES(phone_number)");
            $stmt->bind_param("isss", $id, $full_name, $email, $phone_number);

            // Execute statement
            $stmt->execute();
        }

        fclose($handle);

        header("Location: acceuil.php?message=Clients imported successfully");
        exit();
    } else {
        header("Location: acceuil.php?error=" . urlencode("Error opening file"));
        exit();
    }
} else {
    header("Location: acceuil.php?error=" . urlencode("No file uploaded or upload error"));
    exit();
}

mysqli_close($conn);
?>
