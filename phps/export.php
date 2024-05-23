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
include 'config.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=clients.csv');

$output = fopen('php://output', 'w');

// Output column headings
fputcsv($output, array('ID', 'Full Name', 'Email', 'Phone Number'));

$sql = "SELECT id, full_name, email, phone_number FROM Clients where userid = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
}

fclose($output);
mysqli_close($conn);
exit();
?>
