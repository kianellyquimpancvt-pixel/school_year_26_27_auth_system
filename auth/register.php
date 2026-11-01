<?php
require '../config/database.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = $_POST['address'];
    $age = $_POST['age'];

    $sql = "INSERT INTO users
    (first_name, last_name, email, password, address, age)
    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute([
        $first_name,
        $last_name,
        $email,
        $password,
        $address,
        $age
    ])){
        $message = "Registration Successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h2>User Registration</h2>

<p class="success"><?php echo $message; ?></p>

<form method="POST">

    <label>First Name</label>
    <input type="text" name="first_name" required>

    <label>Last Name</label>
    <input type="text" name="last_name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Address</label>
    <input type="text" name="address">

    <label>Age</label>
    <input type="number" name="age">

    <button type="submit">Register</button>

</form>

</body>
</html>