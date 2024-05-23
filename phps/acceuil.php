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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./styles/style.css">
  <title>Acceuil</title>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ClientManagerPro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sign In/Up
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./sign/signin.php">Sign In</a></li>
                        <li><a class="dropdown-item" href="./sign/signup.php">Sign Up</a></li>
                        <li><a class="dropdown-item" href="./sign/logout.php">log out</a></li>
                    </ul>
                </li>
            </div>
        </div>
    </div>
</nav>

  <!-- body -->
  <a href="./update/add.php" class="btn btn-success">Ajouter</a>
  <a href="export.php" class="btn btn-secondary">Export as CSV</a>
  <form action="import.php" method="POST" enctype="multipart/form-data" >
        <input type="file" name="file" accept=".csv" required>
        <button type="submit">Import</button>
    </form>
  <?php
include 'config.php';

$sql = "SELECT id, full_name, email, phone_number FROM Clients where userid = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table class='styled-table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Full Name</th>";
    echo "<th>Email</th>";
    echo "<th>Phone Number</th>";
    echo "<th>Action</th>"; 
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["full_name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone_number"] . "</td>";
        echo "<td>";
        echo "<a href='./update/edit.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>";
        echo "<form method='POST' action='./update/delete.php' style='display:inline;'>";
        echo "<input type='hidden' name='client_id' value='" . $row["id"] . "'>";
        echo "<button type='submit' name='delete'  class='btn btn-danger'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>



</body>

</html>