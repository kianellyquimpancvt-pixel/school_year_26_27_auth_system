<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

/* INSERT */
if(isset($_POST['product_name']) && !isset($_POST['update'])){

    $product_name = $_POST['product_name'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO products(product_name, added_by)
            VALUES(:product_name, :added_by)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':added_by', $user_id);

    $stmt->execute();

    echo "<p>Product Added Successfully!</p>";
}

/* DELETE */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = "DELETE FROM products WHERE product_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    echo "<p>Product Deleted Successfully!</p>";
}

/* UPDATE */
if(isset($_POST['update'])){

    $id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE products
            SET product_name = :product_name,
                last_updated_by = :updated_by,
                last_updated = NOW()
            WHERE product_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':updated_by', $user_id);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    echo "<p>Product Updated Successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h2>Add Product</h2>

<form method="POST">
    Product Name:
    <input type="text" name="product_name" required>
    <button type="submit">Save</button>
</form>

<br>

<h2>Update Product</h2>

<form method="POST">
    Product ID:
    <input type="number" name="product_id" required>

    New Product Name:
    <input type="text" name="product_name" required>

    <button type="submit" name="update">Update</button>
</form>

<br>

<h2>Product List</h2>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Added By</th>
    <th>Updated By</th>
    <th>Last Updated</th>
    <th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM products";
$stmt = $conn->query($sql);

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>

<tr>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['added_by']; ?></td>
    <td><?php echo $row['last_updated_by']; ?></td>
    <td><?php echo $row['last_updated']; ?></td>
    <td>
        <a href="?delete=<?php echo $row['product_id']; ?>">Delete</a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>