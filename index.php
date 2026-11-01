<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>

<form>

    <h3>Dashboard Menu</h3>

    <button type="button"
        onclick="window.location.href='categories/index.php'">
        Manage Categories
    </button>

    <br><br>

    <button type="button"
        onclick="window.location.href='products/index.php'">
        Manage Products
    </button>

    <br><br>

    <button type="button"
        onclick="window.location.href='auth/logout.php'">
        Logout
    </button>

</form>

</body>
</html>