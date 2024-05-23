<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h1>Edit Client</h1>

    <?php
    include '../config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM Clients WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo $row['full_name']; ?>" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $row['phone_number']; ?>" required><br>
                <input type="submit" value="Update">
            </form>
    <?php
        } else {
            echo "Client not found.";
        }
    } else {
        echo "Client ID not provided.";
    }

    $conn->close();
    ?>
</body>
</html>
