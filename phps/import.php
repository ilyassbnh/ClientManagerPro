<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the sign-in page
    header("Location: ./sign/signin.php");
    exit();
}

// User is logged in, retrieve user information
$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
?>
<?php
include 'config.php'; // Ensure the path to config.php is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file']['tmp_name'];

        // Read CSV file
        $handle = fopen($file, "r");
        if ($handle !== false) {
            // Skip the header row
            fgetcsv($handle);

            // Prepare the SQL statement
            $sql = "INSERT INTO clients (full_name, email, phone_number , userid) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("sssi", $name, $email, $phone , $user_id);

            // Parse CSV rows and insert into database
            while (($data = fgetcsv($handle)) !== false) {
                $name = $data[0];
                $email = $data[1];
                $phone = $data[2];
                $stmt->execute();
            }

            // Close the statement
            $stmt->close();
            
            // Close the file handle
            fclose($handle);

            // Redirect with success message
            header("Location: acceuil.php?message=CSV%20import%20successful");
            exit();
        } else {
            // Error opening file
            header("Location: acceuil.php?error=Error%20opening%20CSV%20file");
            exit();
        }
    } else {
        // No file uploaded or error uploading file
        header("Location: acceuil.php?error=No%20file%20uploaded%20or%20error%20uploading%20file");
        exit();
    }
}

$conn->close();
?>
