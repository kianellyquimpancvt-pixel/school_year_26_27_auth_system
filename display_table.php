<?php

// Include database connection file
require_once 'config/database.php';

// SQL query to retrieve all records
$sql = "SELECT * FROM grocery_items";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();

// Fetch all records
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Grocery Items</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: lightgray;
        }
    </style>
</head>
<body>

    <h2>Grocery Items Table</h2>

    <table>
        <tr>
            <th>Item ID</th>
            <th>Product Name</th>
            <th>Brand Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock Quantity</th>
            <th>Manufacture Date</th>
        </tr>

        <?php foreach ($items as $item) { ?>
        <tr>
            <td><?php echo $item['item_id']; ?></td>
            <td><?php echo $item['product_name']; ?></td>
            <td><?php echo $item['brand_name']; ?></td>
            <td><?php echo $item['category']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['stock_quantity']; ?></td>
            <td><?php echo $item['manufacture_date']; ?></td>
        </tr>
        <?php } ?>

    </table>

</body>
</html>
