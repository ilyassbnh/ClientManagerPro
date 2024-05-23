
<?php
// Include the database connection file
include("../config.php");

// Check if the client ID is provided via POST request
if (isset($_POST['client_id'])) {
    // Get the client ID from the POST data
    $client_id = $_POST['client_id'];

    // SQL to delete the client
    $sql = "DELETE FROM Clients WHERE id = $client_id";

    // Execute the delete query
    if (mysqli_query($conn, $sql)) {
        // Client deleted successfully, redirect to the main page with a success message
        header("Location: ../acceuil.php?message=Client deleted successfully");
        exit();
    } else {
        // Error deleting client, redirect with an error message
        header("Location: ../acceuil.php?error=" . urlencode("Error deleting client: " . mysqli_error($conn)));
        exit();
    }
}

// Close the connection
mysqli_close($conn);
?>
