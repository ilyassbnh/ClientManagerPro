<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <h1>Add New Client</h1>
    <form action="insert.php" method="POST">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required><br>
        <input type="submit" value="Add Client">
    </form>
</body>
</html>
