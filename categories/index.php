<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

/* INSERT */
if(isset($_POST['category_name']) && !isset($_POST['update'])){

    $category_name = $_POST['category_name'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO categories(category_name, added_by)
            VALUES(:category_name, :added_by)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':category_name', $category_name);
    $stmt->bindParam(':added_by', $user_id);

    $stmt->execute();

    echo "<p>Category Added Successfully!</p>";
}

/* DELETE */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = "DELETE FROM categories WHERE category_id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    echo "<p>Category Deleted Successfully!</p>";
}

/* UPDATE */
if(isset($_POST['update'])){

    $id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE categories
            SET category_name = :category_name,
                last_updated_by = :updated_by,
                last_updated = NOW()
            WHERE category_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':category_name', $category_name);
    $stmt->bindParam(':updated_by', $user_id);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    echo "<p>Category Updated Successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>

<h2>Add Category</h2>

<form method="POST">
    Category Name:
    <input type="text" name="category_name" required>
    <button type="submit">Save</button>
</form>

<br>

<h2>Update Category</h2>

<form method="POST">
    Category ID:
    <input type="number" name="category_id" required>

    New Category Name:
    <input type="text" name="category_name" required>

    <button type="submit" name="update">Update</button>
</form>

<br>

<h2>Category List</h2>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Category Name</th>
    <th>Added By</th>
    <th>Updated By</th>
    <th>Last Updated</th>
    <th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM categories";
$stmt = $conn->query($sql);

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>

<tr>
    <td><?php echo $row['category_id']; ?></td>
    <td><?php echo $row['category_name']; ?></td>
    <td><?php echo $row['added_by']; ?></td>
    <td><?php echo $row['last_updated_by']; ?></td>
    <td><?php echo $row['last_updated']; ?></td>
    <td>
        <a href="?delete=<?php echo $row['category_id']; ?>">Delete</a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>