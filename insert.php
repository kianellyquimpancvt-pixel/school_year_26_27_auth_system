<?php

// Include database connection file
require_once 'config/database.php';

// SQL query to insert a new record
$sql = "INSERT INTO grocery_items
(product_name, brand_name, category, price, stock_quantity, manufacture_date)
VALUES (?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Execute the insert statement
$stmt->execute([
    'Thai Milk Tea',
    'ChaTraMue',
    'Beverage',
    85.50,
    50,
    '2026-10-26'
]);

// Display success message
echo "Record inserted successfully!";

?>
